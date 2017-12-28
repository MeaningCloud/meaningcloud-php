<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 28/12/17
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"entity_list":[{"form":"London","id":"01d0d69c7d","sementity":{"class":"instance","fiction":"nonfiction","id":"ODENTITY_CITY","type":"Top>Location>GeoPoliticalEntity>City"},"semgeo_list":[{"adm1":{"form":"England","id":"98db781864"},"adm2":{"form":"Greater London","id":"ed00f6dec4"},"continent":{"form":"Europe","id":"0404ea4d6c"},"country":{"form":"United Kingdom","id":"d29f412b4b","standard_list":[{"id":"ISO3166-1-a2","value":"GB"},{"id":"ISO3166-1-a3","value":"GBR"}]}}],"semld_list":["http:\/\/en.wikipedia.org\/wiki\/London","http:\/\/ar.wikipedia.org\/wiki\/Ù„Ù†Ø¯Ù†","http:\/\/ca.wikipedia.org\/wiki\/Londres","http:\/\/cs.wikipedia.org\/wiki\/LondÃ½n","http:\/\/da.wikipedia.org\/wiki\/London","http:\/\/de.wikipedia.org\/wiki\/London","http:\/\/es.wikipedia.org\/wiki\/Londres","http:\/\/fi.wikipedia.org\/wiki\/Lontoo","http:\/\/fr.wikipedia.org\/wiki\/Londres","http:\/\/he.wikipedia.org\/wiki\/×œ×•× ×“×•×Ÿ","http:\/\/hi.wikipedia.org\/wiki\/à¤²à¤‚à¤¦à¤¨","http:\/\/id.wikipedia.org\/wiki\/London","http:\/\/it.wikipedia.org\/wiki\/Londra","http:\/\/ja.wikipedia.org\/wiki\/ãƒ­ãƒ³ãƒ‰ãƒ³","http:\/\/ko.wikipedia.org\/wiki\/ëŸ°ë˜","http:\/\/nl.wikipedia.org\/wiki\/Londen","http:\/\/no.wikipedia.org\/wiki\/London","http:\/\/pl.wikipedia.org\/wiki\/Londyn","http:\/\/pt.wikipedia.org\/wiki\/Londres","http:\/\/ro.wikipedia.org\/wiki\/Londra","http:\/\/ru.wikipedia.org\/wiki\/Ð›Ð¾Ð½Ð´Ð¾Ð½","http:\/\/sv.wikipedia.org\/wiki\/London","http:\/\/th.wikipedia.org\/wiki\/à¸¥à¸­à¸™à¸”à¸­à¸™","http:\/\/tr.wikipedia.org\/wiki\/Londra","http:\/\/zh.wikipedia.org\/wiki\/ä¼¦æ•¦","http:\/\/d-nb.info\/gnd\/4074335-4","http:\/\/linkedgeodata.org\/triplify\/node107775","http:\/\/linked-web-apis.fit.cvut.cz\/resource\/london_city","http:\/\/linked-web-apis.fit.cvut.cz\/resource\/london_uk_city","http:\/\/data.nytimes.com\/14085781296239331901","http:\/\/sw.cyc.com\/concept\/Mx4rvVjWPJwpEbGdrcN5Y29ycA","http:\/\/umbel.org\/umbel\/rc\/Location_Underspecified","http:\/\/umbel.org\/umbel\/rc\/PopulatedPlace","http:\/\/umbel.org\/umbel\/rc\/Village","http:\/\/sws.geonames.org\/2643743\/","@BBCLondres2012","@LDN","@OlimpicoCaracol","@TelevisaLondres","@TimeOutLondon","@visitlondon","sumo:City"],"variant_list":[{"form":"London","inip":"0","endp":"5"}],"relevance":"100"},{"form":"London","id":"76075d4877","sementity":{"class":"instance","fiction":"nonfiction","id":"ODENTITY_LAST_NAME","type":"Top>Person>LastName"},"semld_list":["sumo:LastName"],"variant_list":[{"form":"London","inip":"0","endp":"5"}],"relevance":"100"}],"concept_list":[{"form":"city","id":"817857ee40","sementity":{"class":"class","fiction":"nonfiction","id":"ODENTITY_CITY","type":"Top>Location>GeoPoliticalEntity>City"},"semld_list":["http:\/\/en.wikipedia.org\/wiki\/City","http:\/\/ar.wikipedia.org\/wiki\/Ù…Ø¯ÙŠÙ†Ø©","http:\/\/ca.wikipedia.org\/wiki\/Ciutat","http:\/\/cs.wikipedia.org\/wiki\/MÄ›sto","http:\/\/de.wikipedia.org\/wiki\/Stadt","http:\/\/es.wikipedia.org\/wiki\/Ciudad","http:\/\/fi.wikipedia.org\/wiki\/Kaupunki","http:\/\/fr.wikipedia.org\/wiki\/Ville","http:\/\/he.wikipedia.org\/wiki\/×¢×™×¨","http:\/\/hi.wikipedia.org\/wiki\/à¤¶à¤¹à¤°","http:\/\/id.wikipedia.org\/wiki\/Kota","http:\/\/it.wikipedia.org\/wiki\/CittÃ ","http:\/\/ja.wikipedia.org\/wiki\/éƒ½å¸‚","http:\/\/ko.wikipedia.org\/wiki\/ë„ì‹œ","http:\/\/nl.wikipedia.org\/wiki\/Stad","http:\/\/no.wikipedia.org\/wiki\/By","http:\/\/pl.wikipedia.org\/wiki\/Miasto","http:\/\/pt.wikipedia.org\/wiki\/Cidade","http:\/\/ro.wikipedia.org\/wiki\/OraÈ™","http:\/\/ru.wikipedia.org\/wiki\/Ð“Ð¾Ñ€Ð¾Ð´","http:\/\/sv.wikipedia.org\/wiki\/Stad","http:\/\/th.wikipedia.org\/wiki\/à¸™à¸„à¸£","http:\/\/tr.wikipedia.org\/wiki\/Åžehir","http:\/\/zh.wikipedia.org\/wiki\/åŸŽå¸‚","http:\/\/d-nb.info\/gnd\/4056723-0","sumo:City"],"variant_list":[{"form":"city","inip":"22","endp":"25"}],"relevance":"100"}],"time_expression_list":[],"money_expression_list":[],"quantity_expression_list":[],"other_expression_list":[],"quotation_list":[],"relation_list":[{"form":"London is a very nice city.","inip":"0","endp":"25","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a very nice city","type":"isAttribute"}],"degree":"1"}]}';
    $response = new MCResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCResponse('');
  }


  /**
   * @depends testConstruct
   * @param MCResponse $response
   */
  public function testResponseIsSuccessful($response) {
    $this->assertTrue($response->isSuccessful());
  }


  public function testResponseIsNotSuccessful() {
    $operationDenied = '{"status":{"code":"100","msg":"Operation denied","credits":"0"}}';
    $response = new MCResponse($operationDenied);
    $this->assertNotNull($response->getResponse());
    $this->assertFalse($response->isSuccessful());
  }


  /**
   * @depends testConstruct
   * @param MCResponse $response
   */
  public function testGetStatusCode($response) {
    $this->assertEquals('0', $response->getStatusCode());
  }


  /**
   * @depends testConstructWithWrongJson
   * @param MCResponse $response
   */
  public function testGetStatusCodeOfWrongResponse($response) {
    $this->assertNull($response->getStatusCode());
  }


  /**
   * @depends testConstruct
   * @param MCResponse $response
   */
  public function testGetStatusMsg($response) {
    $this->assertNotEmpty($response->getStatusMsg());
    $this->assertEquals('OK', $response->getStatusMsg());
  }


  /**
   * @depends testConstructWithWrongJson
   * @param MCResponse $response
   */
  public function testGetStatusMsgOfWrongResponse($response) {
    $this->assertEmpty($response->getStatusMsg());
  }


  /**
   * @depends testConstruct
   * @param MCResponse $response
   */
  public function testGetConsumedCredits($response) {
    $this->assertNotEmpty($response->getConsumedCredits());
    $this->assertEquals(1, $response->getConsumedCredits());
  }


  /**
   * @depends testConstructWithWrongJson
   * @param MCResponse $response
   */
  public function testGetConsumedCreditsOfWrongResponse($response) {
    $this->assertEquals('0', $response->getConsumedCredits());
  }


  /**
   * @depends testConstruct
   * @param MCResponse $response
   */
  public function testGetRemainingCredits($response) {
    $this->assertNotEmpty($response->getRemainingCredits());
    $this->assertEquals('5000', $response->getRemainingCredits());
  }


  /**
   * @depends testConstructWithWrongJson
   * @param MCResponse $response
   */
  public function testGetRemainingCreditsOfWrongResponse($response) {
    $this->assertEmpty($response->getRemainingCredits());
  }


  /**
   * @depends testConstruct
   * @param MCResponse $response
   */
  public function testGetResponse($response) {
    $this->assertNotEmpty($response->getResponse());
  }


  /**
   * @depends testConstruct
   * @param MCResponse $response
   */
  public function testGetResult($response) {
    $this->assertNotEmpty($response->getResults());
  }
}