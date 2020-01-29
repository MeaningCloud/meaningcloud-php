<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 07/01/20
 */

namespace MeaningCloud;


class MCDeepCategorizationRequest extends MCRequest {


  private $endpoint = 'deepcategorization-1.0';
  private $otherParams = array();
  private $extraHeaders = array();
  private $type = MCRequest::CONTENT_TYPE_TXT;


  /**
   * MCDeepCategorizationRequest constructor
   *
   * @param string $key
   * @param string $model
   * @param string $txt
   * @param string $url
   * @param string $doc
   * @param string $polarity
   * @param array $otherParams
   * @param array $extraHeaders
   * @param string $server
   */
  public function __construct($key, $model, $txt="", $url="", $doc="", $polarity="n", $otherParams = array(), $extraHeaders = array(), $server='https://api.meaningcloud.com/') {
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

    $this->addParam('model', $model);
    $this->addParam('polarity', $polarity);
    array_walk($otherParams, [$this, 'addParam']);
  }


  /**
   * Sends request to the Deep Categorization API
   *
   * @return MCDeepCategorizationResponse object
   */
  public function sendDeepCategorizationRequest() {
    $response = $this->sendRequest($this->extraHeaders);
    $deepResponse = new MCDeepCategorizationResponse($response);
    return $deepResponse;
  }

}