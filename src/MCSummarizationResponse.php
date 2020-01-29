<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */

namespace MeaningCloud;


class MCSummarizationResponse extends MCResponse {



  /**
   * MCSummarizationResponse constructor
   * @param string $response string returned by the request
   * @throws \Exception  if the parameters passed are incorrect
   */
  public function __construct($response) {
    if(empty($response))
      throw new \Exception("The request sent did not return a response");
    parent::__construct($response);
  }


  /**
   * @return string with the summary
   */
  public function getSummary() {
    return (isset($this->response['summary']) ? $this->response['summary'] : "");
  }

}