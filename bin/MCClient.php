<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 27/12/17
 */

require_once(__DIR__.'/../vendor/autoload.php');

use MeaningCloud\MCRequest;
use MeaningCloud\MCResponse;

$server = 'https://api.meaningcloud.com/';
$license_key = '<< your license key >>'; // your license key (https://www.meaningcloud.com/developer/account/subscription)

$text = 'London is a very nice city but I also love Madrid.';

try {
  // We are going to make a request to the Language Identification API
  $mc = new MCRequest($server.'lang-2.0', $license_key);

  //We set the content we want to analyze
  $mc->setContentTxt($text);
  //$mc->setContentUrl('https://en.wikipedia.org/wiki/Star_Trek'); //if we want to analyze an URL
  $response = new MCResponse($mc->sendRequest());

  // if there are no errors in the request, we will use the language detected to make a request to Sentiment and Topics
  if($response->isSuccessful()) {
    echo "\nThe request to 'Language Identification' finished successfully!\n";

    $results = $response->getResults();
    if(isset($results['language_list']) && !empty($results['language_list'])) {
      $language = $results['language_list'][0]['language'];
      echo "\tLanguage detected: ".$results['language_list'][0]['name'].' ('.$language.")\n";

      // We are going to make a request to the Topics Extraction API
      $mc_topics = new MCRequest($server.'topics-2.0', $license_key);
      // We set the content we want to analyze
      $mc_topics->setContentTxt($text);

      // We add the required parameters of the API we are using
      $response = $mc_topics->sendTopicsRequest($language, 'e'); //language detected, topic type -> entities

      // if there are no errors in the request, we print the output
      if($response->isSuccessful()) {
        echo "\nThe request to 'Topics Extraction' finished successfully!\n";

        $entities = $response->getEntities();
        if(!empty($entities)) {
          echo "\tEntities detected (".sizeof($entities)."):\n";
          foreach ($entities as $entity) {
            echo "\t\t".$response->getTopicForm($entity).' --> '.$response->getTypeLastNode($response->getOntoType($entity))."\n";
          }
        }
      } else {
        echo "\nOh no! There was the following error: ".$response->getStatusMsg()."\n";
      }
    }
  } else {
    if(is_null($response->getResponse()))
      echo "\nOh no! The request sent did not return a Json\n";
    else
      echo "\nOh no! There was the following error: ".$response->getStatusMsg()."\n";
  }
} catch (Exception $e) {
  echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
}
?>
