<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 08/01/20
 */

namespace MeaningCloud;


class MCSentimentRequest extends MCRequest {


  private $endpoint = 'sentiment-2.1';
  private $otherParams = array();
  private $extraHeaders = array();
  private $type = MCRequest::CONTENT_TYPE_TXT;


  /**
   * MCParserRequest constructor
   *
   * @param string $key
   * @param string $lang
   * @param string $txt
   * @param string $url
   * @param string $doc
   * @param array $otherParams
   * @param array $extraHeaders
   * @param string $server
   * @internal param string $model
   */
  public function __construct($key, $lang, $txt="", $url="", $doc="", $otherParams = array(), $extraHeaders = array(), $server='https://api.meaningcloud.com/') {
    if(substr($server, -1) != '/') {
      $server .= '/';
    }
    $urlAPI = $server.$this->endpoint;
    parent::__construct($urlAPI, $key);

    $this->otherParams = $otherParams;
    $this->extraHeaders = $extraHeaders;

    if(!empty($txt)) {
      $this->type = MCRequest::CONTENT_TYPE_TXT;
      $this->setContentTxt($txt);
    } elseif(!empty($url)) {
      $this->type = MCRequest::CONTENT_TYPE_URL;
      $this->setContentUrl($url);
    } elseif(!empty($doc)) {
      $this->type = MCRequest::CONTENT_TYPE_FILE;
      $this->setContentFile($doc);
    }

    $this->addParam('lang', $lang);
    array_walk($otherParams, [$this, 'addParam']);
  }


  /**
   * Sends request to the Sentiment Analysis API
   *
   * @return MCSentimentResponse object
   */
  public function sendSentimentRequest() {
    $response = $this->sendRequest($this->extraHeaders);
    $sentimentResponse = new MCSentimentResponse($response);
    return $sentimentResponse;
  }

}