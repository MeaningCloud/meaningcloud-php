<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 27/12/17
 */

namespace MeaningCloud;

class MCResponse {

  /** @var  string */
  private $response; //associative array with the response


  /**
   * MCResponse constructor
   * @param string $response string returned by the request
   * @throws \Exception  if the parameters passed are incorrect
   */
  public function __construct($response) {
    if(empty($response))
      throw new \Exception("The request sent did not return a response");
    $this->response = json_decode($response, true);
  }


  /**
   * Checks if the response has been successful at an application level (code returned by the API)
   * @return boolean if the request has finished successfully (application level)
   */
  public function isSuccessful() {
    return ($this->getStatusCode() == '0');
  }


  /********************* Getters and Setters ****************************/


  /**
   * Returns the code of the status or NULL if it doesn't exist
   * @return string|NULL
   */
  public function getStatusCode() {
    if(isset($this->response['status']) && isset($this->response['status']['code'])) {
     return $this->response['status']['code'];
    } else return NULL;
  }



  /**
   * Returns the message of the status or an empty string if it doesn't exist
   * @return string
   */
  public function getStatusMsg() {
    if(isset($this->response['status']) && $this->response['status']['msg']) {
      return $this->response['status']['msg'];
    } else return '';
  }


  /**
   * Returns the credits consumed by the request made
   * @return string
   */
  public function getConsumedCredits()
  {
    if(isset($this->response['status']) && $this->response['status']['credits']) {
      return $this->response['status']['credits'];
    } else return '0';
  }


  /**
   * Returns the remaining credits for the license key used after the request was made
   * @return string
   */
  public function getRemainingCredits() {
    if(isset($this->response['status']) && $this->response['status']['remaining_credits']) {
      return $this->response['status']['remaining_credits'];
    } else return '';
  }


  /**
   * Returns the results from the API without the status of the request
   * @return string
   */
  public function getResults() {
    $results = $this->response;
    if(isset($results['status']))
      unset($results['status']);
    return $results;
  }
}
?>