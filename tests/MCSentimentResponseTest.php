<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 03/01/18
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCSentimentResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"model":"general_en","score_tag":"P+","agreement":"AGREEMENT","subjectivity":"SUBJECTIVE","confidence":"98","irony":"NONIRONIC","sentence_list":[{"text":"\"Main dishes were quite good, but desserts were too sweet for me.\"","inip":"0","endp":"65","bop":"y","confidence":"98","score_tag":"P+","agreement":"AGREEMENT","segment_list":[{"text":"\"Main dishes were quite good","segment_type":"main","inip":"0","endp":"27","confidence":"98","score_tag":"P+","agreement":"AGREEMENT","polarity_term_list":[{"text":"(quite) good","inip":"24","endp":"27","confidence":"98","score_tag":"P+"}]},{"text":"desserts were too sweet for me","segment_type":"main","inip":"34","endp":"63","confidence":"100","score_tag":"P","agreement":"AGREEMENT","polarity_term_list":[{"text":"sweet@A","inip":"52","endp":"56","confidence":"100","score_tag":"P","sentimented_concept_list":[{"form":"dessert","id":"0e15bbd941","variant":"desserts","inip":"34","endp":"41","type":"Top>Product>Food","score_tag":"P"}]}]},{"text":"\"","segment_type":"secondary","inip":"65","endp":"65","confidence":"100","score_tag":"NONE","agreement":"AGREEMENT","polarity_term_list":[],"sentimented_concept_list":[{"form":"dessert","id":"0e15bbd941","variant":"desserts","inip":"34","endp":"41","type":"Top>Product>Food","score_tag":"NONE"}]}],"sentimented_entity_list":[],"sentimented_concept_list":[{"form":"dessert","id":"0e15bbd941","type":"Top>Product>Food","score_tag":"P"}]}],"sentimented_entity_list":[],"sentimented_concept_list":[{"form":"dessert","id":"0e15bbd941","type":"Top>Product>Food","score_tag":"P"}]}';
    $response = new MCSentimentResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCSentimentResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCSentimentResponse('');
  }


  public function testConstructEmptyResult() {
    $outputEmpty = '{"status": {"code": "0","msg": "OK","credits": "1","remaining_credits":"5000"}}';
    $response = new MCSentimentResponse($outputEmpty);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalModel($response) {
    $this->assertNotEmpty($response->getModel());
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalModelWithEmptyInput($response) {
    $this->assertEmpty($response->getModel());
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalScoreTag($response) {
    $this->assertNotEmpty($response->getGlobalScoreTag());
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalScoreTagWithEmptyInput($response) {
    $this->assertEmpty($response->getGlobalScoreTag());
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetScoreTag($response) {
    $sentence_list = $response->getResponse()['sentence_list'];
    $this->assertNotEmpty($response->getScoreTag($sentence_list[0]));
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetScoreTagWithEmptyInput($response) {
    $this->assertEmpty($response->getScoreTag([]));
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalAgreement($response) {
    $this->assertNotEmpty($response->getGlobalAgreement());
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalAgreementWithEmptyInput($response) {
    $this->assertEmpty($response->getGlobalAgreement());
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetAgreement($response) {
    $sentence_list = $response->getResponse()['sentence_list'];
    $this->assertNotEmpty($response->getAgreement($sentence_list[0]));
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetAgreementWithEmptyInput($response) {
    $this->assertEmpty($response->getAgreement([]));
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalSubjectivity($response) {
    $this->assertNotEmpty($response->getSubjectivity());
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalSubjectivityWithEmptyInput($response) {
    $this->assertEmpty($response->getSubjectivity());
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalConfidence($response) {
    $this->assertNotEmpty($response->getGlobalConfidence());
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalConfidenceWithEmptyInput($response) {
    $this->assertEmpty($response->getGlobalConfidence());
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetConfidence($response) {
    $sentence_list = $response->getResponse()['sentence_list'];
    $this->assertNotEmpty($response->getConfidence($sentence_list[0]));
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetConfidenceWithEmptyInput($response) {
    $this->assertEmpty($response->getConfidence([]));
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalIrony($response) {
    $this->assertNotEmpty($response->getIrony());
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalIronyWithEmptyInput($response) {
    $this->assertEmpty($response->getIrony());
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalSentimentedEntities($response) {
    $this->assertTrue(is_array($response->getGlobalSentimentedEntities()));
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalSentimentedEntitiesWithEmptyInput($response) {
    $this->assertTrue(is_array($response->getGlobalSentimentedEntities()));
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetSentimentedEntities($response) {
    $sentence_list = $response->getResponse()['sentence_list'];
    $this->assertTrue(is_array($response->getSentimentedEntities($sentence_list[0])));
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetSentimentedEntitiesWithEmptyInput($response) {
    $this->assertTrue(is_array($response->getSentimentedEntities([])));
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalSentimentedConcepts($response) {
    $this->assertTrue(is_array($response->getGlobalSentimentedConcepts()));
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetGlobalSentimentedConceptsWithEmptyInput($response) {
    $this->assertTrue(is_array($response->getGlobalSentimentedConcepts()));
  }


  /**
   * @depends testConstruct
   * @param MCSentimentResponse $response
   */
  public function testGetSentimentedConcepts($response) {
    $sentence_list = $response->getResponse()['sentence_list'];
    $this->assertTrue(is_array($response->getSentimentedConcepts($sentence_list[0])));
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSentimentResponse $response
   */
  public function testGetSentimentedConceptsWithEmptyInput($response) {
    $this->assertTrue(is_array($response->getSentimentedConcepts([])));
  }


  /**
   * @depends testConstruct
   * @dataProvider scoreTagProvider
   *
   * @param $tag
   * @param $tagString
   * @param MCSentimentResponse $response
   */
  public function testScoreTagToString($tag, $tagString, $response) {
    $this->assertEquals($tagString, $response->scoreTagToString($tag));
  }


  /** Providers */

  public function scoreTagProvider() {
    return array(
      array('P+', 'strong positive'),
      array('P', 'positive'),
      array('NEU', 'neutral'),
      array('N', 'negative'),
      array('N+', 'strong negative'),
      array('NONE', 'no sentiment')
    );
  }

}
