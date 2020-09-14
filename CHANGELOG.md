## 3.0

### Added

- *MCClassRequest* now supports [Text Classification 2.0] (https://www.meaningcloud.com/developer/text-classification/doc/what-is-text-classification).

### Removed
- Text Classification 1.1 has been removed in *MCClassRequest* class.

## 2.0

### Added

-  New classes have been added to implement the requests for several of MeaningCloud services. All these classes inherit from the generic class for MeaningCloud requests, *MCRequest*. These are the new API-specific requests:
    -  [Deep Categorization](https://www.meaningcloud.com/developer/deep-categorization)
    -  [Language Identification](https://www.meaningcloud.com/developer/language-identification)
    -  [Lemmatization, PoS and Parsing](https://www.meaningcloud.com/developer/lemmatization-pos-parsing)
    -  [Sentiment Analysis](https://www.meaningcloud.com/developer/sentiment-analysis)
    -  [Summarization](https://www.meaningcloud.com/developer/summarization)
    -  [Text Classification](https://www.meaningcloud.com/developer/text-classification)
    -  [Text Clustering](https://www.meaningcloud.com/developer/text-clustering)
    -  [Topics Extraction](https://www.meaningcloud.com/developer/topics-extraction)
- New classes have been added to model the response of different services and to provide auxiliary methods for working with the responses of the following services:
    -  [Deep Categorization](https://www.meaningcloud.com/developer/deep-categorization)
    -  [Language Identification](https://www.meaningcloud.com/developer/language-identification)
    -  [Summarization](https://www.meaningcloud.com/developer/summarization)
    -  [Text Clustering](https://www.meaningcloud.com/developer/text-clustering)
    
    All these classes inherit from the generic class for MeaningCloud responses, *MCResponse*.

- A new method for obtaining the dictionary a topic belongs to has been added to the *MCTopicsResponse* class.
- A new script called *MCShowcase* has been added to the bin folder.  It implements a pipeline where plain text files are read from a folder, and two CSV files result as output: one with several types of analyses done over each text, and the results from running Text Clustering over the complete collection.


### Changed

- The *MCClient* example has been adapted to the new version.

### Fixed
- A bug has been fixed in the *getLemmatization* function in *MCParserResponse*.


### Removed

- The following functions have been removed from *MCRequest*: *sendTopicsRequest*, *sendClassRequest*, *sendSentimentRequest*, *sendParserRequest*. The functionality they implemented is now provided by the Request class of the corresponding service.



## 1.1.1

- New response added for the Lemmatization, PoS and Parsing API with functions to easily lemmatize and extract PoS tagging.
- MCRequest now includes a function to call the Lemmatization, PoS and Parsing API directly.

## 1.1

- Specific responses for the following APIs have been added: Topics Extraction, Sentiment Analysis and Text Classification. These responses provide auxiliary functions to work with the results returned by each one of those APIs.
- MCRequest has changed: now a generic request does not return an MCResponse object, but a string that needs to be parsed. Additional functions have been added to use the new response classes added.
- Metadata in composer has been updated.


## 1.0

Intitial version.
 
