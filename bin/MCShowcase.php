<?php
/**
 * This script illustrates how the different functionalities provided by MeaningCloud can be used and combined to extract
 * information from a collection of files. The script receives as input a folder that contains files with plain text (UTF-8)
 * and results in two CSV files, one with analyses for each one of the texts in the folder, and another one with the result 
 * of clustering the files in the folder. Progress of the process will be shown through the console (stout).
 * 
 * Created by MeaningCloud Support Team.
 * Date: 28/01/2020
 */

require_once(__DIR__.'/../vendor/autoload.php');

use MeaningCloud\MCTopicsRequest;
use MeaningCloud\MCLangRequest;
use MeaningCloud\MCSentimentRequest;
use MeaningCloud\MCDeepCategorizationRequest;
use MeaningCloud\MCClassRequest;
use MeaningCloud\MCSummarizationRequest;
use MeaningCloud\MCClusteringRequest;


$server = 'https://api.meaningcloud.com/';
$license_key = '<< your license key >>'; // your license key (https://www.meaningcloud.com/developer/account/subscription)

// @param get_fibo - Determines if the analysis will get FIBO concepts. Access to the pack is needed: https://www.meaningcloud.com/developer/documentation/vertical-packs#financial_industry
$get_fibo =  false;

// @param number_categories - Number of categories to show in the results in Deep Categorization and Text Classification analysis
$number_categories = 1;

// @param topics_relevance_threshold - Relevance used for filtering entities and concepts
$topics_relevance_threshold = 100;

// @param cluster_score_threshold - Relative score used for filtering clusters
$cluster_score_threshold = 100;


if($argc<=2)
  exit("\nusage: MC_Showcase.php <input_files_folder> <output_file_name>\n\n");

$input_folder = $argv[1];
$output_file = $argv[2];


$input_files = [];
foreach(scandir($input_folder) as $file) {
  if(!is_file($input_folder.'/'.$file))
    continue;  
  $input_files[$file] = file_get_contents($input_folder.'/'.$file);
}

echo sizeof($input_files)." files read from '".$input_folder."'\n";

$settings = [
  'server' => $server,
  'license_key' => $license_key,
  'get_fibo' => $get_fibo,
  'number_categories' => $number_categories,
  'topics_relevance_threshold' => $topics_relevance_threshold,
  'cluster_score_threshold' => $cluster_score_threshold
];


if($settings['get_fibo']) {
  $column_labels = ['FileName', 'Text', 'Language', 'Polarity', "Entities", "FIBO", "Concepts", "IAB2", "IPTC", "Summary"];
} else {
  $column_labels = ['FileName', 'Text', 'Language', 'Polarity', "Entities", "Concepts", "IAB2", "IPTC", "Summary"];
}
$csv_results = fopen('./'.$output_file.'.csv', 'w');
fputcsv($csv_results, $column_labels);

$index_count = 1;

// Process texts
foreach ($input_files as $file => $content) {
  echo "Analyzing file ".($index_count++)." of ".sizeof($input_files)."\n";
  $analyses = analyzeText($settings, $content, $get_fibo);  
  fputcsv($csv_results, array_merge([$file, $content], $analyses));
  echo "\tDone!\n";
}

echo "Results printed to '".$output_file.".csv'\n";


// Cluster texts
$clusters = getClustering($settings, $input_files);
$csv_clustering_results = fopen('./'.$output_file.'_clusters.csv', 'w');
fputcsv($csv_clustering_results, ["ClusterName", "Size", "Score", "Documents"]);
if(!empty($clusters)) {
  foreach($clusters as $cluster) {
    fputcsv($csv_clustering_results, $cluster);
  }  
  echo "Clustering results printed to '".$output_file."_clusters.csv'\n";
}




// Analyzes the text passed as a parameter
function analyzeText($settings, $text) {
  $analyses = [];
      
  $analyses[] = identifyLanguage($settings, $text);
  
  $analyses[] = analyzeSentiment($settings, $text);

  // Request to Topics Extraction to find entities and concepts in the text
  $topics = extractTopics($settings, $text);
  $analyses [] = $topics['entities'] ?? '';
  if($settings['get_fibo']) {
    $analyses [] = $topics['fibo_concepts'] ?? '';
  }
  $analyses [] = $topics['concepts'] ?? '';

  $analyses[] = getDeepCategorization($settings, 'IAB_2.0_en', $text);

  $analyses[] = getTextClassification($settings, 'IPTC_en', $text);

  $analyses[] = getSummarization($settings, $text, 3);

  return $analyses;
}


/******************** FUNCTIONS ************************/


// Calls Language Identification and returns the language of the text
function identifyLanguage($settings, $text) {
  try {
    echo "\tDetecting language...\n";
    $request = new MCLangRequest($settings['license_key'], $text);
    $response = $request->sendLangRequest();

    if($response->isSuccessful()) {
      $lang = $response->getLanguages()[0];
      return $response->getLanguageName($lang);
    } else {
      echo "\nOh no! The request to the Language Identification API was not successful: ".$response->getStatusCode().' - '.$response->getStatusMsg()."\n";
      return '';
    }
  } catch (Exception $e) {
    echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
  }
}


// Calls Sentiment Analysis and returns the global polarity for the text
function analyzeSentiment($settings, $text) {
  try {
    echo "\tGetting sentiment analysis...\n";
    $request = new MCSentimentRequest($settings['license_key'], 'en', $text);
    $response = $request->sendSentimentRequest();

    if($response->isSuccessful()) {
      return $response->getGlobalScoreTag();
    } else {
      echo "\nOh no! The request to the Sentiment Analysis API was not successful: ".$response->getStatusCode().' - '.$response->getStatusMsg()."\n";
      return '';
    }
  } catch (Exception $e) {
    echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
  }
}



// We are going to make a request to the Topics Extraction API
function extractTopics($settings, $text) {
  try {
    echo "\tGetting entities and concepts...\n";
    $request = new MCTopicsRequest($settings['license_key'], 'en', $text);
    if($settings['get_fibo']) {
      $request->addParam('ud', 'FIBO_en');
    }
    $response = $request->sendTopicsRequest();
    $no_results_str = '(none)';

    if($response->isSuccessful()) {
      $topics = [];

      // get entities and formats them
      $entities = $response->getEntities();
      if(!empty($entities)) {
        foreach($entities as $ent) {
          if($response->getTopicRelevance($ent) >= $settings['topics_relevance_threshold']) {
            $formatted_entities[] = $response->getTopicForm($ent)." (".$response->getTypeLastNode($response->getOntoType($ent)).")";
          }
        }
        if(!empty($formatted_entities)) {
          $topics['entities'] = implode(', ', $formatted_entities);
        } else {
          $topics['entities'] = $no_results_str;
        }
      } else {
        $topics['entities'] = $no_results_str;
      }


      $concepts = $response->getConcepts();
      if(!empty($concepts)) {
        foreach($concepts as $con) {
          if($settings['get_fibo'] && $response->getDictionary($con) == 'FIBO_en') {
            $formatted_fibo_concepts[] = $response->getTopicForm($con)." (".$response->getTypeLastNode($response->getOntoType($con)).")";
          } elseif($response->getTopicRelevance($con) >= $settings['topics_relevance_threshold']) {
            $formatted_concepts[] = $response->getTopicForm($con)." (".$response->getTypeLastNode($response->getOntoType($con)).")"; 
          }
        }
        if($settings['get_fibo']) {
          if(!empty($formatted_fibo_concepts))
            $topics['fibo_concepts'] = implode(', ', $formatted_fibo_concepts);
          else {
            $topics['fibo_concepts'] = $no_results_str;
          }
        }
        if(!empty($formatted_concepts))
          $topics['concepts'] = implode(', ', $formatted_concepts);
        else {
          $topics['concepts'] = $no_results_str;
        }

      } else {
        if($settings['get_fibo'])
          $topics['fibo_concepts'] = $no_results_str;
        $topics['concepts'] = $no_results_str;
      }

      return $topics;
    } else {
      echo "\nOh no! The request to the Topics Extraction API was not successful: ".$response->getStatusCode().' - '.$response->getStatusMsg()."\n";
      return '';
    }
  } catch (Exception $e) {
    echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
  }
}


// Calls Deep Categorization and obtains the IAB 2.0 categories
function getDeepCategorization($settings, $model, $text) {
  try {
    echo "\tGetting '".str_replace("_", " ", substr($model, 0, strlen($model)-3))."' analysis...\n";
    $request = new MCDeepCategorizationRequest($settings['license_key'], $model, $text);
    $response = $request->sendDeepCategorizationRequest();

    if($response->isSuccessful()) {
      $categories = $response->getCategories();
      foreach($categories as $i=>$cat) {
        if($i < $settings['number_categories']){
          $formatted_cats[] = $response->getCategoryLabel($cat)." (".$response->getCategoryRelevance($cat).")";
        }
      }

      if(!empty($formatted_cats)) {
          return implode(', ', $formatted_cats);
      } else {
          return '(none)';
      } 
      
    } else {
      echo "\nOh no! The request to the Deep Categorization API was not successful: ".$response->getStatusCode().' - '.$response->getStatusMsg()."\n";
      return '(none)';
    }
  } catch (Exception $e) {
    echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
  }
}


// Calls Text Classification and obtains the categories for the model specified
function getTextClassification($settings, $model, $text) {
  try {
    echo "\tGetting '".substr($model, 0, strlen($model)-3)."' classification...\n";
    $request = new MCClassRequest($settings['license_key'], $model, $text);
    $response = $request->sendClassRequest();

    if($response->isSuccessful()) {
      $categories = $response->getCategories();
      foreach($categories as $i=>$cat) {
        if($i < $settings['number_categories']){
          $formatted_cats[] = $response->getCategoryLabel($cat)." (".$response->getCategoryRelevance($cat).")";
        }
      }

      if(!empty($formatted_cats)) {
          return implode(', ', $formatted_cats);
      } else {
          return '(none)';
      }
      
    } else {
      echo "\nOh no! The request to the Text Classification API was not successful: ".$response->getStatusCode().' - '.$response->getStatusMsg()."\n";
      return '(none)';
    }
  } catch (Exception $e) {
    echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
  }
}


// Calls Summarization and returns the summary for the text with the specified number of sentences
function getSummarization($settings, $text, $sentences = 5) {
  try {
    echo "\tSummarizing text in $sentences sentences...\n";
    $request = new MCSummarizationRequest($settings['license_key'], $text, $sentences);
    $response = $request->sendSummarizationRequest();

    if($response->isSuccessful()) {
      return $response->getSummary();
    } else {
      echo "\nOh no! The request to the Summarization API was not successful: ".$response->getStatusCode().' - '.$response->getStatusMsg()."\n";
      return '(none)';
    }
  } catch (Exception $e) {
    echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
  }
}


// Calls Text Clustering and returns an array with the clusters
function getClustering($settings, $text_collection) {
  try {
    echo "\tClustering text collection...\n";
    $request = new MCClusteringRequest($settings['license_key'], 'en', $text_collection);
    $response = $request->sendClusteringRequest();

    if($response->isSuccessful()) {
      $formatted_clusters = [];
      foreach($response->getClusters() as $cluster) {        
        $formatted_clusters [] = array(
          $response->getClusterTitle($cluster),
          $response->getClusterSize($cluster),
          $response->getClusterScore($cluster),
          implode(', ', array_keys($response->getClusterDocuments($cluster)))
        );
      }
      return $formatted_clusters;
    } else {
      echo "\nOh no! The request to the Text Clustering API was not successful: ".$response->getStatusCode().' - '.$response->getStatusMsg()."\n";
      return '';
    }
  } catch (Exception $e) {
    echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
  }
}


?>
