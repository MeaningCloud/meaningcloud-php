<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 07/01/20
 */

namespace MeaningCloud;


class MCDeepCategorizationResponse extends MCResponse {



  /**
   * MCDeepCategorizationResponse constructor
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
  public function getCategories() {
    return (isset($this->response['category_list']) ? $this->response['category_list'] : []);
  }


  /*** Generic auxiliary functions ****/

  /**
   * @param array $category
   * @return string
   */
  public function getCategoryCode($category) {
    return (isset($category['code']) ? $category['code'] : '');
  }


  /**
   * @param array $category
   * @return string
   */
  public function getCategoryLabel($category) {
    return (isset($category['label']) ? $category['label'] : '');
  }


  /**
   * @param array $category
   * @return string
   */
  public function getCategoryAbsRelevance($category) {
    return (isset($category['abs_relevance']) ? $category['abs_relevance'] : '');
  }


  /**
   * @param array $category
   * @return string
   */
  public function getCategoryRelevance($category) {
    return (isset($category['relevance']) ? $category['relevance'] : '');
  }


  /**
   * @param array $category
   * @return string
   */
  public function getCategoryPolarity($category) {
    return (isset($category['polarity']) ? $category['polarity'] : '');
  }


}
