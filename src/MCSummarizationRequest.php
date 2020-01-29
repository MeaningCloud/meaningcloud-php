<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */

namespace MeaningCloud;


class MCSummarizationRequest extends MCRequest {


  private $endpoint = 'summarization-1.0';
  private $otherParams = array();
  private $extraHeaders = array();
  private $type = MCRequest::CONTENT_TYPE_TXT;


  /**
   * MCSummarizationRequest constructor
   *
   * @param string $key
   * @param string $txt
   * @param string $url
   * @param string $doc
   * @param int $sentences
   * @param array $otherParams
   * @param array $extraHeaders
   * @param string $server
   */
  public function __construct($key, $txt="", $url="", $doc="", $sentences=5, $otherParams = array(), $extraHeaders = array(), $server='https://api.meaningcloud.com/') {
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

    $this->addParam('sentences', $sentences);
    array_walk($otherParams, [$this, 'addParam']);
  }


  /**
   * Sends request to the Summarization API
   *
   * @return MCSummarizationResponse object
   */
  public function sendSummarizationRequest() {
    $response = $this->sendRequest($this->extraHeaders);
    $summarizationResponse = new MCSummarizationResponse($response);
    return $summarizationResponse;
  }

}