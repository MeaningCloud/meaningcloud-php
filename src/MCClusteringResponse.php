<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */

namespace MeaningCloud;


class MCClusteringResponse extends MCResponse {



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
   * @return array with the clusters detected
   */
  public function getClusters() {
    return (isset($this->response['cluster_list']) ? $this->response['cluster_list'] : []);
  }


  /*** Generic auxiliary functions ****/

  /**
   * @param array $cluster
   * @return string
   */
  public function getClusterTitle($cluster) {
    return (isset($cluster['title']) ? $cluster['title'] : '');
  }


  /**
   * @param array $cluster
   * @return string
   */
  public function getClusterSize($cluster) {
    return (isset($cluster['size']) ? $cluster['size'] : '');
  }


  /**
   * @param array $cluster
   * @return string
   */
  public function getClusterScore($cluster) {
    return (isset($cluster['score']) ? $cluster['score'] : '');
  }


  /**
   * @param array $cluster
   * @return array
   */
  public function getClusterDocuments($cluster) {
    return (isset($cluster['document_list']) ? $cluster['document_list'] : '');
  }

}
