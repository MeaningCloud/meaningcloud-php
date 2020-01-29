<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCLangResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status": {"code": "0", "msg": "OK", "credits": "1"}, "language_list": [{"language": "en", "relevance": "100", "name": "English", "iso639-3": "eng", "iso639-2": "en"}]}';
    $response = new MCLangResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCLangResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCLangResponse('');
  }


  public function testConstructEmptyResult() {
    $outputEmpty = '{"status": {"code": "0","msg": "OK","credits": "1","remaining_credits":"5000"}}';
    $response = new MCLangResponse($outputEmpty);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  /**
   * @depends testConstruct
   * @param MCLangResponse $response
   * @return array
   */
  public function testGetLanguages($response) {
    $this->assertNotEmpty($response->getLanguages());
    $this->assertTrue(is_array($response->getLanguages()));
    return $response->getLanguages();
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCLangResponse $response
   */
  public function testGetNonexistentLanguages($response) {
    $this->assertEmpty($response->getLanguages());
  }


  /**
   * @depends testConstruct
   * @depends testGetLanguages
   * @param MCLangResponse $response
   * @param array $languages
   */
  public function testGetLanguageCode($response, $languages) {
    $language = isset($languages[0]) ? $languages[0] : [];
    $this->assertNotEmpty($response->getLanguageCode($language));
  }


  /**
   * @depends testConstruct
   * @param MCLangResponse $response
   */
  public function testGetLanguageCodeWithEmptyInput($response) {
    $this->assertEmpty($response->getLanguageCode([]));
  }


  /**
   * @depends testConstruct
   * @depends testGetLanguages
   * @param MCLangResponse $response
   * @param array $languages
   */
  public function testGetLanguageName($response, $languages) {
    $language = isset($languages[0]) ? $languages[0] : [];
    $this->assertNotEmpty($response->getLanguageName($language));
  }


  /**
   * @depends testConstruct
   * @param MCLanResponse $response
   */
  public function testGetLanguageNameWithEmptyInput($response) {
    $this->assertEmpty($response->getLanguageName([]));
  }
}
