<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 02/01/18
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCClusteringResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status":{"code":"0","msg":"OK","credits":"0"},"cluster_list":[{"title":"Girl","size":"2","score":"0.16","document_list":{"2":"the girl","3":"the girl and the giraffes"}},{"title":"Giraffe","size":"2","score":"0.13","document_list":{"1":"the giraffe","3":"the girl and the giraffes"}}]}';
    $response = new MCClusteringResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCClusteringResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCClusteringResponse('');
  }


  public function testConstructEmptyResult() {
    $outputEmpty = '{"status": {"code": "0","msg": "OK","credits": "1","remaining_credits":"5000"}}';
    $response = new MCClusteringResponse($outputEmpty);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  /**
   * @depends testConstruct
   * @param MCClusteringResponse $response
   * @return array
   */
  public function testGetClusters($response) {
    $this->assertNotEmpty($response->getClusters());
    $this->assertTrue(is_array($response->getClusters()));
    return $response->getClusters();
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCClusteringResponse $response
   */
  public function testGetNonexistentClusters($response) {
    $this->assertEmpty($response->getClusters());
  }


  /**
   * @depends testConstruct
   * @depends testGetClusters
   * @param MCClusteringResponse $response
   * @param array $clusters
   */
  public function testGetClusterTitle($response, $clusters) {
    $cluster = isset($clusters[0]) ? $clusters[0] : [];
    $this->assertNotEmpty($response->getClusterTitle($cluster));
  }


  /**
   * @depends testConstruct
   * @param MCClusteringResponse $response
   */
  public function testGetClusterTitleWithEmptyInput($response) {
    $this->assertEmpty($response->getClusterTitle([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetClusters
   * @param MCClusteringResponse $response
   * @param array $clusters
   */
  public function testGetClusterSize($response, $clusters) {
    $cluster = isset($clusters[0]) ? $clusters[0] : [];
    $this->assertNotEmpty($response->getClusterSize($cluster));
  }


  /**
   * @depends testConstruct
   * @param MCClusteringResponse $response
   */
  public function testGetClusterSizeWithEmptyInput($response) {
    $this->assertEmpty($response->getClusterSize([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetClusters
   * @param MCClusteringResponse $response
   * @param array $clusters
   */
  public function testGetClusterScore($response, $clusters) {
    $cluster = isset($clusters[0]) ? $clusters[0] : [];
    $this->assertNotEmpty($response->getClusterScore($cluster));
  }


  /**
   * @depends testConstruct
   * @param MCClusteringResponse $response
   */
  public function testGetClusterScoreWithEmptyInput($response) {
    $this->assertEmpty($response->getClusterScore([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetClusters
   * @param MCClusteringResponse $response
   * @param array $clusters
   */
  public function testGetClusterDocuments($response, $clusters) {
    $cluster = isset($clusters[0]) ? $clusters[0] : [];
    $this->assertNotEmpty($response->getClusterDocuments($cluster));
    $this->assertTrue(is_array($response->getClusterDocuments($cluster)));
  }


  /**
   * @depends testConstruct
   * @param MCClusteringResponse $response
   */
  public function testGetClusterDocumentsWithEmptyInput($response) {
    $this->assertEmpty($response->getClusterDocuments([]));
  }

}