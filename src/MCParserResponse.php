<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 23/03/2018
 */

namespace MeaningCloud;


class MCParserResponse extends MCResponse {



  /**
   * MCParserResponse constructor
   * @param string $response string returned by the request
   * @throws \Exception  if the parameters passed are incorrect
   */
  public function __construct($response) {
    if(empty($response))
      throw new \Exception("The request sent did not return a response");
    parent::__construct($response);
  }


  /**
   * This function obtains the lemmas and PoS for the text sent
   * @param boolean fullPOSTag set to true to obtain the complete PoS tag
   * @return array of tokens from the syntactic tree with their lemmas and PoS
   */
  public function getLemmatization($fullPOSTag = false) {
    $leaves = $this->getTreeLeaves();
    $lemmas = array();
    foreach($leaves as $leaf) {
      $analyses = array();
      if(isset($leaf['analysis_list'])) {
        foreach($leaf['analysis_list'] as $analysis) {
          $analyses[] = array(
            'lemma' => $analysis['lemma'],
            'pos' => ($fullPOSTag) ? $analysis['tag'] : substr($analysis['tag'], 0, 2)
          );
        }
      }
      $lemmas[$leaf['form']] = $analyses;
    }
    return $lemmas;
  }


  /*** Generic auxiliary functions ****/

  /**
   * This function gets the response and provides the leaf tokens of the syntactic trees
   * @return array of tokens from the syntactic tree
   */
  private function getTreeLeaves() {
    if(isset($this->response['token_list'])) {
      $leaves = array();
      foreach($this->response['token_list'] as $sentence) {
        $this->traverseTree($sentence, $leaves);
      }
    }
    return $leaves;
  }


  /**
   * This function traverses the tree with the analysis of the input (token). Every time it
   * reaches a leaf, it adds it to the leaves array.
   * @param array $token node of the syntactic tree
   * @param reference array where the leaves will be stored
   */
  private function traverseTree(&$token, &$leaves){
    if(isset($token['token_list'])){
      foreach($token['token_list'] as &$token){
        if(isset($token['token_list'])){ //there are more
          $this->traverseTree($token, $leaves);
        }else{
          $leaves[]=$token; //it's a leaf!
        }
      }
    }
  }//traverseTree

} // MCParserResponse

