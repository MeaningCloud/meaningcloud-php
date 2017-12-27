<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 27/12/17
 */

require_once(__DIR__.'/../vendor/autoload.php');

use MeaningCloud\MCRequest;

$server = 'https://api.meaningcloud.com/';
$license_key = '<< your license key >>'; // your license key (https://www.meaningcloud.com/developer/account/subscription)

try {
// We are going to make a request to the Topics Extraction API
  $mc = new MCRequest($server.'topics-2.0', $license_key);


// We add the required parameters of the API we are using
  $mc->addParam('lang', 'en'); //languages -> English
  $mc->addParam('tt', 'e'); //topic type -> entities


//We set the content we want to analyze
  $mc->setContentTxt('London is a very nice city but I also love Madrid.');
  //$mc->setContentUrl('https://en.wikipedia.org/wiki/Star_Trek');//if we want to analyze an URL
  $response = $mc->sendRequest();


// if there are no errors in the request, we print the output
  if($response->isSuccessful()) {
    echo "\nThe request finished successfully!\n";

    $results = $response->getResults();
    if(isset($results['entity_list'])) {
      echo "Entities detected (".sizeof($results['entity_list'])."):\n";
      foreach ($results['entity_list'] as $entity) {
        echo "\t".$entity['form'].' --> '.(isset($entity['sementity']['type']) ? $entity['sementity']['type'] : 'Unknown')."\n";
      }
    }
  } else {
    echo "\nOh no! There was the following error: ".$response->getStatusMsg()."\n";
  }
}catch (Exception $e) {
  echo "\nEXCEPTION: ".$e->getMessage().' ('.$e->getFile().':'.$e->getLine().')'."\n\n";
}
?>