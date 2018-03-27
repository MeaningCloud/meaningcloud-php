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
composer require meaningcloud/meaningcloud-php
```

### Configuration

The only thing you need to start using MeaningCloud's APIs is to log into MeaningCloud (by registering or using other services to log in). Once you've done that, you will be given a license key (https://www.meaningcloud.com/developer/account/subscription). Copy it and paste it in the corresponding place in the code, select the API you want to use and the parameters you want to use, and that's it.

You can find all the technical documentation about the APIs in the API section of the website: https://www.meaningcloud.com/developer/apis

And we are always available at support@meaningcloud.com


### Functionality

This SDK currently contains the following:

- **MCRequest**: to easily create a request to any of MeaningCloud's APIS.
- **MCResponse**: models a generic response from the MeaningCloud API.
    - **MCTopicsResponse**: models a response from the Topic Extraction API, providing auxiliary functions to work with the response, extracting the different types of topics and some of the most used fields in them.
    - **MCClassResponse**: models a response from the Text Classification API, providing auxiliary functions to work with the response and extract the different fields in each category.
    - **MCSentimentResponse**: models a response from the Sentiment Analysis API, providing auxiliary functions to work with the response and extract the sentiment detected at different levels and for different elements.
    - **MCParserResponse**: models a response from the Lemmatization, PoS and Parsing API, providing auxiliary functions to work with the response and extract the lemmas and the PoS tagging of a text.
    
    
### Usage

This is an example on how to use this client (also included in the _bin_ folder). This code makes to requests, once to the Language Identification API and another one to the Topic Extraction API using the language detected in the first request. The results of both requests are printed in the standard output:

```php 

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
      $response = $mc_topics->sendTopicsRequest($language, 'e'); //languages -> English, topic type -> entities

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

```
