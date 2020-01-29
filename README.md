# MeaningCloud for PHP

This is MeaningCloud's official PHP client, designed to enable you to use MeaningCloud's services easily from your own applications.

## MeaningCloud

MeaningCloud is a cloud-based text analytics service that through APIs allows you extract meaning from all kind of unstructured content: social conversation, articles, documents... You can check our demos here: https://www.meaningcloud.com/demos

The different APIs provide easy access to many NLP tasks such as automatic classification, sentiment analysis, topic extraction, etc. To be able to use the service you just have to log into MeaningCloud (by registering or using other services to log in: https://www.meaningcloud.com/developer/login), and you will receive a license key subscribed to a Free plan with up to 20k credits.

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

Some resources are included in vertical (https://www.meaningcloud.com/developer/documentation/vertical-packs) or language packs (https://www.meaningcloud.com/developer/documentation/language-packs). To use them, you have to have access to them, either by requesting the 30-day period free trial we give for all of them or by subscribing to the corresponding pack.

We are always available at support@meaningcloud.com


### Functionality

This SDK currently contains the following:
- **MCRequest**: to easily create a request to any of MeaningCloud's APIS. It can also be used to directly generate requests without using specific classes.
    - **MCClassRequest**: models a request to MeaningCloud Text Classification API.
    - **MCClusteringRequest**: models a request to MeaningCloud Text Clustering API.
    - **MCDeepCategorizationRequest**: models a request to MeaningCloud Deep Categorization API.
    - **MCLanguageRequest**: models a request to MeaningCloud Language Identification API.
    - **MCParserRequest**: models a request to Meaningcloud Lemmatization, PoS and Parsing API.
    - **MCSentimentRequest**: models a request to MeaningCloud Sentiment Analysis API.
    - **MCSummarizationRequest**: models a request to Meaningcloud Summarization API.
    - **MCTopicsRequest**: models a request to MeaningCloud TopicsExtraction API.

- **MCResponse**: models a generic response from the MeaningCloud API.
    - **MCClassResponse**: models a response from the Text Classification API, providing auxiliary functions to work with the response and extract the different fields in each category.
    - **MCClusteringResponse**: models a response from the Text Clustering API, providing auxiliary functions to work with the response and extract the different fields in each cluster.
    - **MCDeepCategorizationResponse**: models a response from the Deep Categorization API, providing auxiliary functions to work with the response and extract the different fields in each category.
    - **MCLanguageResponse**: models a response from the Language Identification API, providing auxiliary functions to work with the response and extract the sentiment detected at different levels and for different elements.
    - **MCParserResponse**: models a response from the Lemmatization, PoS and Parsing API, providing auxiliary functions to work with the response and extract the lemmas and the PoS tagging of a text.
    - **MCSentimentResponse**: models a response from the Sentiment Analysis API, providing auxiliary functions to work with the response and extract the sentiment detected at different levels and for different elements.
    - **MCSummarizationResponse**: models a response from the Summarization API, providing auxiliary functions to work with the response and obtain the summary extracted.
    - **MCTopicsResponse**: models a response from the Topic Extraction API, providing auxiliary functions to work with the response, extracting the different types of topics and some of the most used fields in them.
    
    
### Usage

In the *bin* folder, there are two examples:

- **MCClient.php**, which contains a simple example on how to use the SDK

- **MCShowcase**, which implements a pipeline where plain text files are read from a folder, and two CSV files result as output: one with several types of analyses done over each text, and the results from running Text Clustering (https://www.meaningcloud.com/developer/text-clustering) over the complete collection. The analyses done are:
    - Language Identification (https://www.meaningcloud.com/developer/language-identification): detects the language and returns code or name
    - Sentiment Analysis (https://www.meaningcloud.com/developer/sentiment-analysis): detects the global polarity detected in the text
    - Topics Extraction (https://www.meaningcloud.com/developer/topics-extraction): detects the most relevant entities and concepts in the text. If the get_fibo variable is enabled, FIBO concepts will be output (requires access to the Financial Industry pack(https://www.meaningcloud.com/developer/documentation/vertical-packs#financial_industry))
    - Deep Categorization (https://www.meaningcloud.com/developer/deep-categorization): categorizes the text according to the IAB 2.0 taxonomy
    - Text Classification (https://www.meaningcloud.com/developer/text-classification): classifies the text according the IPTC taxonomy
    - Summarization (https://www.meaningcloud.com/developer/summarization): extracts a summary from the text


Below is an example on how to use this client (also included in the _bin_ folder). This code makes two requests, one to the Language Identification API and another to the Topic Extraction API using the language detected in the first request. The results of both requests are printed in the standard output:

```php 

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
```
