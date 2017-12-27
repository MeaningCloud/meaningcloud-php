<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 27/12/17
 */

namespace MeaningCloud;

class MCRequest
{

  /** @var  string */
  private $url;
  /** @var  string */
  private $key;
  /** @var  array */
  private $params;

  const CONTENT_TYPES = ['txt', 'url', 'doc'];

  /**
   * MCRequest constructor.
   * @param $url
   * @param $key
   */
  public function __construct($url, $key)
  {
    $this->url = $url;
    $this->key = $key;
    $this->params = [];
  }


  /**
   * Add a parameter to the request.
   * @param string $paramName name of the parameter
   * @param string $paramValue value of the parameter
   */
  public function addParam($paramName, $paramValue)
  {
    $this->params[$paramName] = $paramValue;
  }


  /**
   * @param $type
   * @param $value
   */
  private function setContent($type, $value) {
    if(in_array($type, self::CONTENT_TYPES)) {

    } else {
      // TODO exceptions....
    }
  }


  /**
   * @param $txt
   */
  public function setContentTxt($txt) {
    $this->setContent('txt', $txt);
  }


  /**
   * @param $url
   */
  public function setContentUrl($url) {
    $this->setContent('url', $url);
  }


  /**
   * @param $file
   */
  public function setContentFile($file) {
    $this->setContent('doc', $file);
  }


  /** Getters and Setters */

  /**
   * @return string
   */
  public function getUrl()
  {
    return $this->url;
  }


  /**
   * @param string $url
   */
  public function setUrl($url)
  {
    $this->url = $url;
  }

  /**
   * @return string
   */
  public function getKey()
  {
    return $this->key;
  }


  /**
   * @param string $key
   */
  public function setKey($key)
  {
    $this->key = $key;
  }

  /**
   * @return array
   */
  public function getParams()
  {
    return $this->params;
  }


  /**
   * @param array $params
   */
  public function setParams($params)
  {
    $this->params = $params;
  }


}

?>