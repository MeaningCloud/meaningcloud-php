<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 02/01/18
 */

namespace MeaningCloud;


class MCSentimentResponse extends MCResponse {



  /**
   * MCSentimentResponse constructor
   * @param string $response string returned by the request
   * @throws \Exception  if the parameters passed are incorrect
   */
  public function __construct($response) {
    if(empty($response))
      throw new \Exception("The request sent did not return a response");
    parent::__construct($response);
  }


  /****** Getters for the different objects returned ***/

  /**
   * Obtains the sentiment model used to obtain the response
   *
   * @return string
   */
  public function getModel() {
    return (isset($this->response['model']) ? $this->response['model'] : '');
  }


  /**
   * Obtains the global score tag of the response
   *
   * @return string
   */
  public function getGlobalScoreTag() {
    return $this->getScoreTag($this->response);
  }


  /**
   * Obtains the score tag field of a node (if it applies)
   *
   * @param array $node
   * @return string
   */
  public function getScoreTag($node) {
    return (isset($node['score_tag']) ? $node['score_tag'] : '');
  }


  /**
   * Obtains the global agreement of the response
   *
   * @return string
   */
  public function getGlobalAgreement() {
    return $this->getAgreement($this->response);
  }


  /**
   * Obtains the agreement field of a node (if it applies)
   *
   * @param array $node
   * @return string
   */
  public function getAgreement($node) {
    return (isset($node['agreement']) ? $node['agreement'] : '');
  }


  /**
   * Obtains the global subjectivity of the response
   *
   * @return string
   */
  public function getSubjectivity() {
    return (isset($this->response['subjectivity']) ? $this->response['subjectivity'] : '');
  }



  /**
   * Obtains the global confidence of the response
   *
   * @return string
   */
  public function getGlobalConfidence() {
    return $this->getConfidence($this->response);
  }


  /**
   * Obtains the confidence field of a node (if it applies)
   *
   * @param array $node
   * @return string
   */
  public function getConfidence($node) {
    return (isset($node['confidence']) ? $node['confidence'] : '');
  }


  /**
   * Obtains the global irony of the response
   *
   * @return string
   */
  public function getIrony() {
    return (isset($this->response['irony']) ? $this->response['irony'] : '');
  }


  /**
   * Obtains the entities identified in the text with the global polarity associated to them
   *
   * @return array
   */
  public function getGlobalSentimentedEntities() {
    return $this->getSentimentedEntities($this->response);
  }


  /**
   * Obtains the entities identified in the text with the polarity associated to them in the node
   *
   * @param array $node
   * @return array
   */
  public function getSentimentedEntities($node) {
    return (isset($node['sentimented_entity_list']) ? $node['sentimented_entity_list'] : []);
  }


  /**
   * Obtains the concepts identified in the text with the global polarity associated to them
   *
   * @return array
   */
  public function getGlobalSentimentedConcepts() {
    return $this->getSentimentedConcepts($this->response);
  }


  /**
   * Obtains the concepts identified in the text with the polarity associated to them in the node
   *
   * @param array $node
   * @return array
   */
  public function getSentimentedConcepts($node) {
    return (isset($node['sentimented_concept_list']) ? $node['sentimented_concept_list'] : []);
  }


  /*** Generic auxiliary functions ***/

  /**
   * @param $scoreTag
   * @return string
   */
  public function scoreTagToString($scoreTag) {
    $scoreTagString = '';
    if($scoreTag == 'P+')
      $scoreTagString = 'strong positive';
    elseif($scoreTag == 'P')
      $scoreTagString = 'positive';
    elseif($scoreTag == 'NEU')
      $scoreTagString = 'neutral';
    elseif($scoreTag == 'N')
      $scoreTagString = 'negative';
    elseif($scoreTag == 'N+')
      $scoreTagString = 'strong negative';
    elseif($scoreTag == 'NONE')
      $scoreTagString = 'no sentiment';

    return $scoreTagString;
  }

}

