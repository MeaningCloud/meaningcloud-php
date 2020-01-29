<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 28/12/17
 */

namespace MeaningCloud;


class MCTopicsResponse extends MCResponse {



  /**
   * MCTopicsResponse constructor
   * @param string $response string returned by the request
   * @throws \Exception  if the parameters passed are incorrect
   */
  public function __construct($response) {
    if(empty($response))
      throw new \Exception("The request sent did not return a response");
    parent::__construct($response);
  }


  /****** Getters for the different types of topics returned ***/

  /**
   * @return array with the entities detected
   */
  public function getEntities() {
      return (isset($this->response['entity_list']) ? $this->response['entity_list']: []);
  }


  /**
   * @return array with the concepts detected
   */
  public function getConcepts() {
    return (isset($this->response['concept_list']) ? $this->response['concept_list']: []);
  }


  /**
   * @return array with the time expressions detected
   */
  public function getTimeExpressions() {
    return (isset($this->response['time_expression_list']) ? $this->response['time_expression_list']: []);
  }


  /**
   * @return array with the money expressions detected
   */
  public function getMoneyExpressions() {
    return (isset($this->response['money_expression_list']) ? $this->response['money_expression_list']: []);
  }


  /**
   * @return array with the quantity expressions detected
   */
  public function getQuantityExpressions() {
    return (isset($this->response['quantity_expression_list']) ? $this->response['quantity_expression_list']: []);
  }


  /**
   * @return array with the other expressions detected
   */
  public function getOtherExpressions() {
    return (isset($this->response['other_expression_list']) ? $this->response['other_expression_list']: []);
  }


  /**
   * @return array with the quotations detected
   */
  public function getQuotations() {
    return (isset($this->response['quotation_list']) ? $this->response['quotation_list']: []);
  }


  /**
   * @return array with the relations detected
   */
  public function getRelations() {
    return (isset($this->response['relation_list']) ? $this->response['relation_list']: []);
  }


  /*** Generic auxiliary functions ****/

  /**
   * @param array $topic
   * @return string
   */
  public function getTopicForm($topic) {
    return (isset($topic['form']) ? $topic['form']: '');
  }


  /**
   * @param array $topic
   * @return string
   */
  public function getTopicRelevance($topic) {
    return (isset($topic['relevance']) ? $topic['relevance']: '');
  }


  /**
   * Obtains the ontology type of a topic (if it applies)
   *
   * @param array $topic
   * @return string
   */
  public function getOntoType($topic) {
    return (isset($topic['sementity']['type']) ? $topic['sementity']['type'] : '');
  }


  /**
   * Obtain the last node or leaf of the type specified
   *
   * @param string $type type we want to analyze (sementity, semtheme)
   * @return string
   */
  public function getTypeLastNode($type) {
    $lastNode = '';
    if(!empty($type) && !is_array($type)) {
      $aType = explode('>', $type);
      $lastNode = $aType[sizeof($aType)-1];
    }
    return $lastNode;
  }

  /**
   * Obtains the "dictionary" an entity/concept comes from
   *
   * @param $topic
   * @return bool true if the field dictionary is in the topic
   */
  public function getDictionary($topic) {
    return (isset($topic['dictionary']) ? $topic['dictionary'] : '');
  }


  /**
   * Checks the field "dictionary" to check if a/n entity/concept comes from a user dictionary
   *
   * @param $topic
   * @return bool true if the field dictionary is in the topic
   */
  public function isUserDefined($topic) {
    return isset($topic['dictionary']);
  }

  /**
   * Gets the number of appearances of a topic
   *
   * @param array $topic
   * @return int number of appearances
   */
  public function getNumberOfAppearances($topic) {
    if(isset($topic)) {
      if(isset($topic['variant_list']))
        return sizeof($topic['variant_list']);
      else
        return 1;
    } else
      return 0;
  }

}

