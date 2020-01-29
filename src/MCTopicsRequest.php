<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 07/01/20
 */

namespace MeaningCloud;


class MCTopicsRequest extends MCRequest {


  private $endpoint = 'topics-2.0';
  private $otherParams = array();
  private $extraHeaders = array();
  private $type = MCRequest::CONTENT_TYPE_TXT;


  /**
   * MCTopicsRequest constructor
   *
   * @param string $key
   * @param string $lang
   * @param string $txt
   * @param string $url
   * @param string $doc
   * @param string $topicType
   * @param array $otherParams
   * @param array $extraHeaders
   * @param string $server
   * @internal param string $model
   */
  public function __construct($key, $lang, $txt="", $url="", $doc="", $topicType="a", $otherParams = array(), $extraHeaders = array(), $server='https://api.meaningcloud.com/') {
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
    $this->addParam('tt', $topicType);
    array_walk($otherParams, [$this, 'addParam']);
  }


  /**
   * Sends request to the Topics Extraction API
   *
   * @return MCTopicsResponse object
   */
  public function sendTopicsRequest() {
    $response = $this->sendRequest($this->extraHeaders);
    $topicsResponse = new MCTopicsResponse($response);
    return $topicsResponse;
  }

}