<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 02/01/18
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCClassResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status": {"code": "0","msg": "OK","credits": "1","remaining_credits":"5000"},"category_list": [{"code": "01021001","label": "arts, culture and entertainment - entertainment (general) - entertainment award","abs_relevance": "0.48236102","relevance": "100"},{"code": "08006000","label": "human interest - award and prize","abs_relevance": "0.28744578","relevance": "60"}]}';
    $response = new MCClassResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCClassResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCClassResponse('');
  }


  public function testConstructEmptyResult() {
    $outputEmpty = '{"status": {"code": "0","msg": "OK","credits": "1","remaining_credits":"5000"}}';
    $response = new MCClassResponse($outputEmpty);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  /**
   * @depends testConstruct
   * @param MCClassResponse $response
   * @return array
   */
  public function testGetCategories($response) {
    $this->assertNotEmpty($response->getCategories());
    $this->assertTrue(is_array($response->getCategories()));
    return $response->getCategories();
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCClassResponse $response
   */
  public function testGetNonexistentCategories($response) {
    $this->assertEmpty($response->getCategories());
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCClassResponse $response
   * @param array $categories
   */
  public function testGetCategoryCode($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryCode($category));
  }


  /**
   * @depends testConstruct
   * @param MCClassResponse $response
   */
  public function testGetCategoryCodeWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryCode([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCClassResponse $response
   * @param array $categories
   */
  public function testGetCategoryLabel($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryLabel($category));
  }


  /**
   * @depends testConstruct
   * @param MCClassResponse $response
   */
  public function testGetCategoryLabelWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryLabel([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCClassResponse $response
   * @param array $categories
   */
  public function testGetCategoryAbsRelevance($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryAbsRelevance($category));
  }


  /**
   * @depends testConstruct
   * @param MCClassResponse $response
   */
  public function testGetCategoryAbsRelevanceWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryAbsRelevance([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCClassResponse $response
   * @param array $categories
   */
  public function testGetCategoryRelevance($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryRelevance($category));
  }


  /**
   * @depends testConstruct
   * @param MCClassResponse $response
   */
  public function testGetCategoryRelevanceWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryRelevance([]));
  }

}