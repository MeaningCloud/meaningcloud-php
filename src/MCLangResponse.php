<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */

namespace MeaningCloud;


class MCLangResponse extends MCResponse {



  /**
   * MCLangResponse constructor
   * @param string $response string returned by the request
   * @throws \Exception  if the parameters passed are incorrect
   */
  public function __construct($response) {
    if(empty($response))
      throw new \Exception("The request sent did not return a response");
    parent::__construct($response);
  }


  /**
   * @return array with the categories detected
   */
  public function getLanguages() {
    return (isset($this->response['language_list']) ? $this->response['language_list'] : []);
  }


  /*** Generic auxiliary functions ****/

  /**
   * @param array $language
   * @return string
   */
  public function getLanguageCode($language) {
    return (isset($language['language']) ? $language['language'] : '');
  }


  /**
   * @param array $language
   * @return string
   */
  public function getLanguageName($language) {
    return (isset($language['name']) ? $language['name'] : '');
  }



}
