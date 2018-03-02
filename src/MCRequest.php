<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 27/12/17
 */

namespace MeaningCloud;

class MCRequest {

  /** @var  string */
  private $url;
  /** @var  array */
  private $params;
  /** @var  int */
  private $timeout = 60;

  // content types
  const CONTENT_TYPE_TXT = 'txt';
  const CONTENT_TYPE_URL = 'url';
  const CONTENT_TYPE_FILE = 'doc';


  /**
   * MCRequest constructor.
   * @param string $url URL of the API against which the request will be made
   * @param string $key license key
   * @throws \Exception if the parameters passed are incorrect
   */
  public function __construct($url, $key) {
    if(empty($url) || empty($key))
      throw new \Exception('URL and key cannot be empty');
    $this->url = $url;
    $this->params = [];
    $this->addParam('key', $key);
  }


  /**
   * Add a parameter to the request.
   * @param string $paramName name of the parameter
   * @param string $paramValue value of the parameter
   * @throws \Exception if the parameters passed are incorrect
   */
  public function addParam($paramName, $paramValue) {
    if(empty($paramName))
      throw new \Exception('paramName cannot be empty');
    $this->params[$paramName] = $paramValue;
  }


  /**
   * Sets the content that's going to be sent to analyze according to its type.
   *
   * @param string $type with the type of content (text, file or url)
   * @param string $value value of the content
   */
  private function setContent($type, $value) {
    if(in_array($type, [self::CONTENT_TYPE_TXT, self::CONTENT_TYPE_URL, self::CONTENT_TYPE_FILE])) {
      if($type == self::CONTENT_TYPE_FILE)
        $this->addParam('doc', curl_file_create(realpath($value)));
      else
        $this->addParam($type, $value);
    }
  }


  /**
   * Sets a text content to send to the API.
   *
   * @param string $txt
   */
  public function setContentTxt($txt) {
    $this->setContent(self::CONTENT_TYPE_TXT, $txt);
  }


  /**
   * Sets a URL content to send to the API.
   * @param $url
   */
  public function setContentUrl($url) {
    $this->setContent(self::CONTENT_TYPE_URL, $url);
  }


  /**
   * Sets a File content to send to the API.
   * @param $file
   */
  public function setContentFile($file) {
    $this->setContent(self::CONTENT_TYPE_FILE, $file);
  }


  /**
   * Sends request to the Topic Extraction API
   *
   * @param string $lang language of the text
   * @param string $topicType type of topics to extract
   * @param array $otherParams other parameters to send
   * @param array $extraHeaders
   * @return MCTopicsResponse
   */
  public function sendTopicsRequest($lang, $topicType, $otherParams = array(), $extraHeaders = array()) {
    $this->addParam('lang', $lang);
    $this->addParam('tt', $topicType);
    array_walk($otherParams, [$this,'addParam']);

    $response = $this->sendRequest($extraHeaders);
    return new MCTopicsResponse($response);
  }


  /**
   * Sends request to the Text Classification API
   *
   * @param string $model classification model to use
   * @param array $otherParams
   * @param array $extraHeaders
   * @return MCClassResponse
   */
  public function sendClassRequest($model, $otherParams = array(), $extraHeaders = array()) {
    $this->addParam('model', $model);
    array_walk($otherParams, [$this, 'addParam']);

    $response = $this->sendRequest($extraHeaders);
    return new MCClassResponse($response);
  }


  /**
   * Sends request to the Topic Extraction API
   *
   * @param string $lang language of the text
   * @param string $model sentiment model to use
   * @param array $otherParams other parameters to send
   * @param array $extraHeaders
   * @return MCSentimentResponse
   */
  public function sendSentimentRequest($lang, $model, $otherParams = array(), $extraHeaders = array()) {
    $this->addParam('lang', $lang);
    $this->addParam('model', $model);
    array_walk($otherParams, [$this, 'addParam']);

    $response = $this->sendRequest($extraHeaders);
    return new MCSentimentResponse($response);
  }



  /**
   * Sends a request to the URL specified and returns a response only if the HTTP code returned is OK
   *
   * @param array $extraHeaders allows to configure additional headers in the request
   * @return MCResponse object set to NULL if there is an error
   */
  public function sendRequest($extraHeaders = array()) {
    $this->addParam('src', 'mc-php');
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $this->url);
    curl_setopt($curl, CURLOPT_HEADER, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    if(defined('CURLOPT_SSL_VERIFYSTATUS'))
      curl_setopt($curl, CURLOPT_SSL_VERIFYSTATUS, 0);
    curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->timeout);
    if($this->params) {
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $this->params);
    }
    if(!empty($extraHeaders))
      curl_setopt($curl, CURLOPT_HTTPHEADER, $extraHeaders);
    $result = curl_exec($curl);
    $info = curl_getinfo($curl);
    curl_close($curl);
    $response = substr($result, $info['header_size']);
    return $response;
  } // sendRequest



  /********************* Getters and Setters ****************************/

  /**
   * Get the url of the request
   * @return string with the url
   */
  public function getUrl() {
    return $this->url;
  }


  /**
   * Set a new URL
   * @param string $url
   */
  public function setUrl($url) {
    $this->url = $url;
  }


  /**
   * Get the params attribute
   * @return array
   */
  public function getParams() {
    return $this->params;
  }


  /**
   * Get the timeout value
   * @return integer
   */
  public function getTimeout() {
    return $this->timeout;
  }


  /**
   * Set a new timeout value
   * @param integer $timeout
   */
  public function setTimeout($timeout) {
    $this->timeout = $timeout;
  }
}
?>
