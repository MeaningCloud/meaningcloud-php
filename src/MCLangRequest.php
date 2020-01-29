<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */

namespace MeaningCloud;


class MCLangRequest extends MCRequest {


  private $endpoint = 'lang-2.0';
  private $otherParams = array();
  private $extraHeaders = array();
  private $type = MCRequest::CONTENT_TYPE_TXT;


  /**
   * MCLangRequest constructor
   *
   * @param string $key
   * @param string $txt
   * @param string $url
   * @param string $doc
   * @param array $otherParams
   * @param array $extraHeaders
   * @param string $server
   */
  public function __construct($key, $txt="", $url="", $doc="", $otherParams = array(), $extraHeaders = array(), $server='https://api.meaningcloud.com/') {
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

    array_walk($otherParams, [$this, 'addParam']);
  }


  /**
   * Sends request to the Language Detection API
   *
   * @return MCLangResponse object
   */
  public function sendLangRequest() {
    $response = $this->sendRequest($this->extraHeaders);
    $langResponse = new MCLangResponse($response);
    return $langResponse;
  }

}