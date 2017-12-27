# MeaningCloud for PHP

This is MeaningCloud's official PHP client, designed to enable you to use MeaningCloud's services easily from your own applications.

## MeaningCloud

MeaningCloud is a cloud-based text analytics service that through APIs allows you extract meaning from all kind of unstructured content: social conversation, articles, documents... You can check our demos here: https://www.meaningcloud.com/demos

The different APIs provide easy access to many NLP tasks such as automatic classification, sentiment analysis, topic extraction, etc. To be able to use the service you just have to log into MeaningCloud (by registering or using other services to log in: https://www.meaningcloud.com/developer/login), and you will receive a license key associated to a basic Free plan.

You can read more about the plans and the features available here: https://www.meaningcloud.com/products/pricing


## Getting started

### Installation

You can load meaningcloud-php into your project by using Composer (https://getcomposer.org/).

If you already have composer installed, you just need to run the following:

``` 
composer require meaningcloud/public/meaningcloud-php
```

### Configuration

The only thing you need to start using MeaningCloud's APIs is to log into MeaningCloud (by registering or using other services to log in). Once you've done that, you will be given a license key (https://www.meaningcloud.com/developer/account/subscription). Copy it and paste it in the corresponding place in the code, select the API you want to use and the parameters you want to use, and that's it.

You can find all the technical documentation about the APIs in the API section of the website: https://www.meaningcloud.com/developer/apis

And we are always available at support@meaningcloud.com


### Usage

This is an example on how to use this client (also included in the _bin_ folder):

```php 
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

```