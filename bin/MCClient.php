<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 27/12/17
 */

require_once(__DIR__.'/../vendor/autoload.php');

use MeaningCloud\MCRequest;
use MeaningCloud\MCLangResponse;
use MeaningCloud\MCTopicsRequest;

$server = 'https://api.meaningcloud.com/';
$license_key = '<< your license key >>'; // your license key (https://www.meaningcloud.com/developer/account/subscription)

$text = 'London is a very nice city but I also love Madrid.';

try {
  // We are going to make a request to the Language Identification API
  $mc = new MCRequest($server.'lang-2.0', $license_key);

  //We set the content we want to analyze
  $mc->setContentTxt($text);
  //$mc->setContentUrl('https://en.wikipedia.org/wiki/Star_Trek'); //if we want to analyze an URL
  $langResponse = new MCLangResponse($mc->sendRequest());

  // if there are no errors in the request, we will use the language detected to make a request to Sentiment and Topics
  if($langResponse->isSuccessful()) {
    echo "\nThe request to 'Language Identification' finished successfully!\n";


    $languages = $langResponse->getLanguages();
    if(!empty($languages)) {
      $language = $languages[0];
      $codeLanguage = $langResponse->getLanguageCode($language);
      echo "\tLanguage detected: ".$langResponse->getLanguageName($language).' ('.$codeLanguage.")\n";

      // We are going to make a request to the Topics Extraction API
      $mc_topics = new MCTopicsRequest($license_key, $codeLanguage, $text);

      // We send the request to the API
      $topicsResponse = $mc_topics->sendTopicsRequest();

      // if there are no errors in the request, we print the output
      if($topicsResponse->isSuccessful()) {
        echo "\nThe request to 'Topics Extraction' finished successfully!\n";

        $entities = $topicsResponse->getEntities();
        if(!empty($entities)) {
          echo "\tEntities detected (".sizeof($entities)."):\n";
          foreach ($entities as $entity) {
            echo "\t\t".$topicsResponse->getTopicForm($entity).' --> '.$topicsResponse->getTypeLastNode($topicsResponse->getOntoType($entity))."\n";
          }
        }
      } else {
        echo "\nOh no! There was the following error: ".$topicsResponse->getStatusMsg()."\n";
      }
    }
  } else {
    if(is_null($langResponse->getResponse()))
      echo "\nOh no! The request sent did not return a Json\n";
    else
      echo "\nOh no! There was the following error: ".$langResponse->getStatusMsg()."\n";
  }
} catch (Exception $e) {
  echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
}
?>
