<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 07/01/20
 */

namespace MeaningCloud;


class MCClassRequest extends MCRequest {


  private $endpoint = 'class-2.0';
  private $otherParams = array();
  private $extraHeaders = array();
  private $type = MCRequest::CONTENT_TYPE_TXT;
  private $hierarchy = 'n';


  /**
   * MCClassRequest constructor
   *
   * @param string $key
   * @param string $model
   * @param string $txt
   * @param string $url
   * @param string $doc
   * @param array $otherParams
   * @param array $extraHeaders
   * @param string $server
   * @param string $hierarchy
   */
  public function __construct($key, $model, $txt="", $url="", $doc="",
                              $otherParams = array(), $extraHeaders = array(),
                              $server='https://api.meaningcloud.com/',
                              $hierarchy="n", $version="2.0") {

    if($version != '1.1' && $version != '2.0'){
      echo("Invalid version, only 1.1 and 2.0 are supported, received " . $version);
      exit();
    }

    if(substr($server, -1) != '/') {
      $server .= '/';
    }
    $urlAPI = $server.$this->endpoint;
    parent::__construct($urlAPI, $key);

    $this->otherParams = $otherParams;
    $this->extraHeaders = $extraHeaders;
    if($version == '2.0'){
      $this->hierarchy = $hierarchy;
    }

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
    array_walk($otherParams, [$this, 'addParam']);
  }


  /**
   * Sends request to the Text Classification API
   *
   * @return MCClassResponse object
   */
  public function sendClassRequest() {
    $response = $this->sendRequest($this->extraHeaders);
    $classResponse = new MCClassResponse($response);
    return $classResponse;
  }

}
