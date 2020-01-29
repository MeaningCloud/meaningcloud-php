<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */

namespace MeaningCloud;


class MCClusteringRequest extends MCRequest {


  private $endpoint = 'clustering-1.1';
  private $otherParams = array();
  private $extraHeaders = array();
  private $type = MCRequest::CONTENT_TYPE_TXT;


  /**
   * MCClusteringRequest constructor
   *
   * @param string $key
   * @param string $lang
   * @param array $text_collection where the key is the ID of the text
   * @param string $mode
   * @param array $otherParams
   * @param array $extraHeaders
   * @param string $server
   */
  public function __construct($key, $lang, $text_collection='', $mode='tm', $otherParams = array(), $extraHeaders = array(), $server='https://api.meaningcloud.com/') {
    if(substr($server, -1) != '/') {
      $server .= '/';
    }
    $urlAPI = $server.$this->endpoint;
    parent::__construct($urlAPI, $key);

    $this->otherParams = $otherParams;
    $this->extraHeaders = $extraHeaders;

    $this->type = MCRequest::CONTENT_TYPE_TXT;

    if(!empty($text_collection)) {
      foreach($text_collection as $id => $t) {
        $texts[$id] = $this->cleanText($t);
      }
      $this->setContentTxt(implode("\n", array_values($texts)));
      $this->addParam('id', implode("\n", array_keys($texts)));
    }

    $this->addParam('lang', $lang);
    $this->addParam('mode', $mode);
    array_walk($otherParams, [$this, 'addParam']);
  }


  /**
   * Sends request to the Text Clustering API
   *
   * @return MCClusteringResponse object
   */
  public function sendClusteringRequest() {
    $response = $this->sendRequest($this->extraHeaders);
    $clusteringResponse = new MCClusteringResponse($response);
    return $clusteringResponse;
  }


  /**
   * Cleans a text of potentially problematic characters
   *
   * @return string
   */
  private function cleanText($t) {
    $characters = ["/\r/u", "/\n/u", "/\f/u", "/\\x00/u", "/\\x01/u", "/\\x02/u"];
    return preg_replace($characters," ", $t);
  }

}