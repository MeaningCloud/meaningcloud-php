<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 07/01/20
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCDeepCategorizationResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"1179999"},"category_list":[{"code":"Quality>SpeedAgility","label":"Speed and agility","abs_relevance":"2","relevance":"100","polarity":"NONE"},{"code":"Company>Citibank","label":"Citibank","abs_relevance":"1","relevance":"100"},{"code":"CustomerService>AccessibilityCommunication","label":"Accessibility and communication","abs_relevance":"1","relevance":"100"},{"code":"Operation>Participants","label":"Participants","abs_relevance":"1","relevance":"100"},{"code":"Satisfaction>Negative","label":"Negative","abs_relevance":"1","relevance":"100"}]}';
    $response = new MCDeepCategorizationResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCDeepCategorizationResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCDeepCategorizationResponse('');
  }


  public function testConstructEmptyResult() {
    $outputEmpty = '{"status": {"code": "0","msg": "OK","credits": "1","remaining_credits":"5000"}}';
    $response = new MCDeepCategorizationResponse($outputEmpty);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  /**
   * @depends testConstruct
   * @param MCDeepCategorizationResponse $response
   * @return array
   */
  public function testGetCategories($response) {
    $this->assertNotEmpty($response->getCategories());
    $this->assertTrue(is_array($response->getCategories()));
    return $response->getCategories();
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCDeepCategorizationResponse $response
   */
  public function testGetNonexistentCategories($response) {
    $this->assertEmpty($response->getCategories());
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCDeepCategorizationResponse $response
   * @param array $categories
   */
  public function testGetCategoryCode($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryCode($category));
  }


  /**
   * @depends testConstruct
   * @param MCDeepCategorizationResponse $response
   */
  public function testGetCategoryCodeWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryCode([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCDeepCategorizationResponse $response
   * @param array $categories
   */
  public function testGetCategoryLabel($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryLabel($category));
  }


  /**
   * @depends testConstruct
   * @param MCDeepCategorizationResponse $response
   */
  public function testGetCategoryLabelWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryLabel([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCDeepCategorizationResponse $response
   * @param array $categories
   */
  public function testGetCategoryAbsRelevance($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryAbsRelevance($category));
  }


  /**
   * @depends testConstruct
   * @param MCDeepCategorizationResponse $response
   */
  public function testGetCategoryAbsRelevanceWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryAbsRelevance([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCDeepCategorizationResponse $response
   * @param array $categories
   */
  public function testGetCategoryRelevance($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryRelevance($category));
  }


  /**
   * @depends testConstruct
   * @param MCDeepCategorizationResponse $response
   */
  public function testGetCategoryRelevanceWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryRelevance([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetCategories
   * @param MCDeepCategorizationResponse $response
   * @param array $categories
   */
  public function testGetCategoryPolarity($response, $categories) {
    $category = isset($categories[0]) ? $categories[0] : [];
    $this->assertNotEmpty($response->getCategoryPolarity($category));
  }


  /**
   * @depends testConstruct
   * @param MCDeepCategorizationResponse $response
   */
  public function testGetCategoryPolarityWithEmptyInput($response) {
    $this->assertEmpty($response->getCategoryPolarity([]));
  }

}