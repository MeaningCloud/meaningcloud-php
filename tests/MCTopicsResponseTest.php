<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 28/12/17
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCTopicsResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status":{"code":"0","msg":"OK","credits":"1"},"entity_list":[{"form":"London","id":"01d0d69c7d","sementity":{"class":"instance","fiction":"nonfiction","id":"ODENTITY_CITY","type":"Top>Location>GeoPoliticalEntity>City"},"semgeo_list":[{"adm1":{"form":"England","id":"98db781864"},"adm2":{"form":"Greater London","id":"ed00f6dec4"},"continent":{"form":"Europe","id":"0404ea4d6c"},"country":{"form":"United Kingdom","id":"d29f412b4b","standard_list":[{"id":"ISO3166-1-a2","value":"GB"},{"id":"ISO3166-1-a3","value":"GBR"}]}}],"semld_list":["http://en.wikipedia.org/wiki/London","http://ar.wikipedia.org/wiki/لندن","http://ca.wikipedia.org/wiki/Londres","http://cs.wikipedia.org/wiki/Londýn","http://da.wikipedia.org/wiki/London","http://de.wikipedia.org/wiki/London","http://es.wikipedia.org/wiki/Londres","http://fi.wikipedia.org/wiki/Lontoo","http://fr.wikipedia.org/wiki/Londres","http://he.wikipedia.org/wiki/לונדון","http://hi.wikipedia.org/wiki/लंदन","http://id.wikipedia.org/wiki/London","http://it.wikipedia.org/wiki/Londra","http://ja.wikipedia.org/wiki/ロンドン","http://ko.wikipedia.org/wiki/런던","http://nl.wikipedia.org/wiki/Londen","http://no.wikipedia.org/wiki/London","http://pl.wikipedia.org/wiki/Londyn","http://pt.wikipedia.org/wiki/Londres","http://ro.wikipedia.org/wiki/Londra","http://ru.wikipedia.org/wiki/Лондон","http://sv.wikipedia.org/wiki/London","http://th.wikipedia.org/wiki/ลอนดอน","http://tr.wikipedia.org/wiki/Londra","http://zh.wikipedia.org/wiki/伦敦","http://d-nb.info/gnd/4074335-4","http://linkedgeodata.org/triplify/node107775","http://linked-web-apis.fit.cvut.cz/resource/london_city","http://linked-web-apis.fit.cvut.cz/resource/london_uk_city","http://data.nytimes.com/14085781296239331901","http://sw.cyc.com/concept/Mx4rvVjWPJwpEbGdrcN5Y29ycA","http://umbel.org/umbel/rc/Location_Underspecified","http://umbel.org/umbel/rc/PopulatedPlace","http://umbel.org/umbel/rc/Village","http://sws.geonames.org/2643743/","@BBCLondres2012","@LDN","@OlimpicoCaracol","@TelevisaLondres","@TimeOutLondon","@visitlondon","sumo:City"],"variant_list":[{"form":"London","inip":"0","endp":"5"}],"relevance":"100"},{"form":"London","id":"76075d4877","sementity":{"class":"instance","fiction":"nonfiction","id":"ODENTITY_LAST_NAME","type":"Top>Person>LastName"},"semld_list":["sumo:LastName"],"variant_list":[{"form":"London","inip":"0","endp":"5"}],"relevance":"100"}],"concept_list":[{"form":"city","id":"817857ee40","sementity":{"class":"class","fiction":"nonfiction","id":"ODENTITY_CITY","type":"Top>Location>GeoPoliticalEntity>City"},"semld_list":["http://en.wikipedia.org/wiki/City","http://ar.wikipedia.org/wiki/مدينة","http://ca.wikipedia.org/wiki/Ciutat","http://cs.wikipedia.org/wiki/Město","http://de.wikipedia.org/wiki/Stadt","http://es.wikipedia.org/wiki/Ciudad","http://fi.wikipedia.org/wiki/Kaupunki","http://fr.wikipedia.org/wiki/Ville","http://he.wikipedia.org/wiki/עיר","http://hi.wikipedia.org/wiki/शहर","http://id.wikipedia.org/wiki/Kota","http://it.wikipedia.org/wiki/Città","http://ja.wikipedia.org/wiki/都市","http://ko.wikipedia.org/wiki/도시","http://nl.wikipedia.org/wiki/Stad","http://no.wikipedia.org/wiki/By","http://pl.wikipedia.org/wiki/Miasto","http://pt.wikipedia.org/wiki/Cidade","http://ro.wikipedia.org/wiki/Oraș","http://ru.wikipedia.org/wiki/Город","http://sv.wikipedia.org/wiki/Stad","http://th.wikipedia.org/wiki/นคร","http://tr.wikipedia.org/wiki/Şehir","http://zh.wikipedia.org/wiki/城市","http://d-nb.info/gnd/4056723-0","sumo:City"],"variant_list":[{"form":"city","inip":"17","endp":"20"}],"relevance":"100"},{"form":"$","id":"__9145003407816029121","sementity":{"class":"class","type":"Top>Unit>Currency"},"variant_list":[{"form":"$","inip":"30","endp":"30"}],"relevance":"100"},{"form":"tortoise","id":"1019079343","sementity":{"class":"class","fiction":"nonfiction","id":"ODENTITY_REPTILE","type":"Top>LivingThing>Animal>Vertebrate>Reptile"},"semld_list":["http://en.wikipedia.org/wiki/Tortoise","http://ar.wikipedia.org/wiki/سلاحف_برية","http://ca.wikipedia.org/wiki/Testudínid","http://cs.wikipedia.org/wiki/Testudovití","http://de.wikipedia.org/wiki/Landschildkröten","http://es.wikipedia.org/wiki/Testudinidae","http://fi.wikipedia.org/wiki/Testudinidae","http://fr.wikipedia.org/wiki/Tortues_terrestres","http://he.wikipedia.org/wiki/צבים_יבשתיים","http://hi.wikipedia.org/wiki/स्थलीय_कछुआ","http://id.wikipedia.org/wiki/Kura-kura","http://it.wikipedia.org/wiki/Testudinidae","http://ja.wikipedia.org/wiki/リクガメ科","http://ko.wikipedia.org/wiki/땅거북과","http://nl.wikipedia.org/wiki/Landschildpadden","http://no.wikipedia.org/wiki/Landskilpadder","http://pl.wikipedia.org/wiki/Żółwie_lądowe","http://pt.wikipedia.org/wiki/Testudinidae","http://ro.wikipedia.org/wiki/Testudinidae","http://ru.wikipedia.org/wiki/Сухопутные_черепахи","http://sv.wikipedia.org/wiki/Landsköldpaddor","http://tr.wikipedia.org/wiki/Kara_kaplumbağası","http://zh.wikipedia.org/wiki/陸龜","sumo:Reptile"],"semtheme_list":[{"id":"ODTHEME_ZOOLOGY","type":"Top>NaturalSciences>Zoology"}],"variant_list":[{"form":"turtles","inip":"41","endp":"47"}],"relevance":"100"}],"time_expression_list":[{"form":"the 5th of November","normalized_form":"|||||11|5||||","actual_time":"2017-11-05","precision":"day","inip":"53","endp":"71"},{"form":"5th of November","normalized_form":"|||||11|5||||","actual_time":"2017-11-05","precision":"day","inip":"57","endp":"71"}],"money_expression_list":[{"form":"$5","amount_form":"5","numeric_value":"5","currency":"USD","inip":"30","endp":"31"}],"quantity_expression_list":[{"form":"two turtles","amount_form":"two","numeric_value":"2","unit":"turtle","inip":"37","endp":"47"}],"other_expression_list":[{"form":"1245FG","type":"unknown","inip":"104","endp":"109"}],"quotation_list":[{"form":"he was tired in flight 1245FG.","verb":{"form":"said","lemma":"say"},"inip":"81","endp":"110"}],"relation_list":[{"form":"On the 5th of November he said he was tired in flight 1245FG.","inip":"73","endp":"109","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"said","lemma_list":["say"],"sense_id_list":["ODENTITY_COMMUNICATION_PROCESS","ODENTITY_LINGUISTIC_COMMUNICATION","ODENTITY_PROCESS"]},"complement_list":[{"form":"he was tired in flight 1245FG","type":"isDirectObject"}],"degree":"1"},{"form":"London is a nice city.","inip":"0","endp":"20","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a nice city","type":"isAttribute"}],"degree":"1"},{"form":"I have $5 and two turtles.","inip":"23","endp":"47","subject":{"form":"I","lemma_list":["I"],"sense_id_list":["PRONHUMAN"]},"verb":{"form":"have","lemma_list":["have"]},"complement_list":[{"form":"$5 and two turtles","type":"isDirectObject"}],"degree":"1"},{"form":"On the 5th of November he said he was tired in flight 1245FG.","inip":"81","endp":"109","subject":{"form":"he","lemma_list":["he"],"sense_id_list":["PRONHUMAN"]},"verb":{"form":"was tired","lemma_list":["tire"]},"complement_list":[{"form":"in flight","type":"isComplement"}],"degree":"1"}]}';
    $response = new MCTopicsResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCTopicsResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCTopicsResponse('');
  }


  /**
   * @depends testConstruct
   * @param MCTopicsResponse $response
   */
  public function testGetEntities($response) {
    $this->assertNotEmpty($response->getEntities());
    $this->assertTrue(is_array($response->getEntities()));
  }


  public function testGetNonexistentEntities() {
    $responseWithNoEntities = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"time_expression_list":[],"money_expression_list":[],"quantity_expression_list":[],"other_expression_list":[],"quotation_list":[],"relation_list":[{"form":"London is a very nice city.","inip":"0","endp":"25","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a very nice city","type":"isAttribute"}],"degree":"1"}]}';
    $response = new MCTopicsResponse($responseWithNoEntities);
    $this->assertTrue(is_array($response->getEntities()));
    $this->assertEmpty($response->getEntities());
  }


  /**
   * @depends testConstruct
   * @param MCTopicsResponse $response
   */
  public function testGetConcepts($response) {
    $this->assertNotEmpty($response->getConcepts());
    $this->assertTrue(is_array($response->getConcepts()));
  }


  public function testGetNonexistentConcepts() {
    $responseWithNoConcepts = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"time_expression_list":[],"money_expression_list":[],"quantity_expression_list":[],"other_expression_list":[],"quotation_list":[],"relation_list":[{"form":"London is a very nice city.","inip":"0","endp":"25","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a very nice city","type":"isAttribute"}],"degree":"1"}]}';
    $response = new MCTopicsResponse($responseWithNoConcepts);
    $this->assertTrue(is_array($response->getConcepts()));
    $this->assertEmpty($response->getConcepts());
  }


  /**
   * @depends testConstruct
   * @param MCTopicsResponse $response
   */
  public function testGetMoneyExpressions($response) {
    $this->assertNotEmpty($response->getMoneyExpressions());
    $this->assertTrue(is_array($response->getMoneyExpressions()));
  }


  public function testGetNonexistentMoneyExpressions() {
    $responseWithNoMoneyExpressions = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"time_expression_list":[],"quantity_expression_list":[],"other_expression_list":[],"quotation_list":[],"relation_list":[{"form":"London is a very nice city.","inip":"0","endp":"25","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a very nice city","type":"isAttribute"}],"degree":"1"}]}';
    $response = new MCTopicsResponse($responseWithNoMoneyExpressions);
    $this->assertTrue(is_array($response->getMoneyExpressions()));
    $this->assertEmpty($response->getMoneyExpressions());
  }


  /**
   * @depends testConstruct
   * @param MCTopicsResponse $response
   */
  public function testGetQuantityExpressions($response) {
    $this->assertNotEmpty($response->getQuantityExpressions());
    $this->assertTrue(is_array($response->getQuantityExpressions()));
  }


  public function testGetNonexistentQuantityExpressions() {
    $responseWithNoQuantityExpressions = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"time_expression_list":[],"money_expression_list":[],"other_expression_list":[],"quotation_list":[],"relation_list":[{"form":"London is a very nice city.","inip":"0","endp":"25","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a very nice city","type":"isAttribute"}],"degree":"1"}]}';
    $response = new MCTopicsResponse($responseWithNoQuantityExpressions);
    $this->assertTrue(is_array($response->getQuantityExpressions()));
    $this->assertEmpty($response->getQuantityExpressions());
  }


  /**
   * @depends testConstruct
   * @param MCTopicsResponse $response
   */
  public function testGetTimeExpressions($response) {
    $this->assertNotEmpty($response->getTimeExpressions());
    $this->assertTrue(is_array($response->getTimeExpressions()));
  }


  public function testGetNonexistentTimeExpressions() {
    $responseWithNoTimeExpressions = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"money_expression_list":[],"quantity_expression_list":[],"other_expression_list":[],"quotation_list":[],"relation_list":[{"form":"London is a very nice city.","inip":"0","endp":"25","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a very nice city","type":"isAttribute"}],"degree":"1"}]}';
    $response = new MCTopicsResponse($responseWithNoTimeExpressions);
    $this->assertTrue(is_array($response->getTimeExpressions()));
    $this->assertEmpty($response->getTimeExpressions());
  }


  /**
   * @depends testConstruct
   * @param MCTopicsResponse $response
   */
  public function testGetOtherExpressions($response) {
    $this->assertNotEmpty($response->getOtherExpressions());
    $this->assertTrue(is_array($response->getOtherExpressions()));
  }


  public function testGetNonexistentOtherExpressions() {
    $responseWithNoOtherExpressions = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"money_expression_list":[],"quantity_expression_list":[],"other_expression_list":[],"quotation_list":[],"relation_list":[{"form":"London is a very nice city.","inip":"0","endp":"25","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a very nice city","type":"isAttribute"}],"degree":"1"}]}';
    $response = new MCTopicsResponse($responseWithNoOtherExpressions);
    $this->assertTrue(is_array($response->getOtherExpressions()));
    $this->assertEmpty($response->getOtherExpressions());
  }


  /**
   * @depends testConstruct
   * @param MCTopicsResponse $response
   */
  public function testGetQuotations($response) {
    $this->assertNotEmpty($response->getQuotations());
    $this->assertTrue(is_array($response->getQuotations()));
  }


  public function testGetNonexistentQuotations() {
    $responseWithNoQuotations = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"time_expression_list":[],"money_expression_list":[],"quantity_expression_list":[],"other_expression_list":[]}';
    $response = new MCTopicsResponse($responseWithNoQuotations);
    $this->assertTrue(is_array($response->getQuotations()));
    $this->assertEmpty($response->getQuotations());
  }


  /**
   * @depends testConstruct
   * @param MCTopicsResponse $response
   */
  public function testGetRelations($response) {
    $this->assertNotEmpty($response->getRelations());
    $this->assertTrue(is_array($response->getRelations()));
  }


  public function testGetNonexistentRelations() {
    $responseWithNoRelations = '{"status":{"code":"0","msg":"OK","credits":"1","remaining_credits":"5000"},"time_expression_list":[],"money_expression_list":[],"quantity_expression_list":[],"other_expression_list":[],"quotation_list":[]}';
    $response = new MCTopicsResponse($responseWithNoRelations);
    $this->assertTrue(is_array($response->getRelations()));
    $this->assertEmpty($response->getRelations());
  }


  /**
   * @depends testConstruct
   * @depends testGetEntities
   * @depends testGetConcepts
   * @depends testGetTimeExpressions
   * @depends testGetMoneyExpressions
   * @depends testGetQuantityExpressions
   * @depends testGetOtherExpressions
   * @depends testGetQuotations
   * @depends testGetRelations
   *
   * @param MCTopicsResponse $response
   */
  public function testGetForm($response) {
    $this->assertNotEmpty($response->getTopicForm($response->getEntities()[0]));
    $this->assertNotEmpty($response->getTopicForm($response->getConcepts()[0]));
    $this->assertNotEmpty($response->getTopicForm($response->getTimeExpressions()[0]));
    $this->assertNotEmpty($response->getTopicForm($response->getMoneyExpressions()[0]));
    $this->assertNotEmpty($response->getTopicForm($response->getQuantityExpressions()[0]));
    $this->assertNotEmpty($response->getTopicForm($response->getOtherExpressions()[0]));
    $this->assertNotEmpty($response->getTopicForm($response->getQuotations()[0]));
    $this->assertNotEmpty($response->getTopicForm($response->getRelations()[0]));
  }


  /**
   * @depends testConstruct
   * @depends testGetEntities
   * @depends testGetConcepts
   * @depends testGetTimeExpressions
   * @depends testGetMoneyExpressions
   * @depends testGetQuantityExpressions
   * @depends testGetOtherExpressions
   * @depends testGetQuotations
   * @depends testGetRelations
   *
   * @param MCTopicsResponse $response
   */
  public function testGetRelevance($response) {
    $this->assertNotEmpty($response->getTopicRelevance($response->getEntities()[0]));
    $this->assertNotEmpty($response->getTopicRelevance($response->getConcepts()[0]));
    $this->assertEmpty($response->getTopicRelevance($response->getTimeExpressions()[0]));
    $this->assertEmpty($response->getTopicRelevance($response->getMoneyExpressions()[0]));
    $this->assertEmpty($response->getTopicRelevance($response->getQuantityExpressions()[0]));
    $this->assertEmpty($response->getTopicRelevance($response->getOtherExpressions()[0]));
    $this->assertEmpty($response->getTopicRelevance($response->getQuotations()[0]));
    $this->assertEmpty($response->getTopicRelevance($response->getRelations()[0]));
  }


  /**
   * @depends testConstruct
   * @depends testGetEntities
   * @depends testGetConcepts
   *
   * @param MCTopicsResponse $response
   */
  public function testGetOntoType($response) {
    //correct values
    $firstEntityOntoType = $response->getOntoType($response->getEntities()[0]);
    $this->assertNotEmpty($firstEntityOntoType);
    $this->assertEquals($firstEntityOntoType, 'Top>Location>GeoPoliticalEntity>City');

    $firstConceptOntoType = $response->getOntoType($response->getConcepts()[0]);
    $this->assertNotEmpty($firstConceptOntoType);
    $this->assertEquals($firstConceptOntoType, 'Top>Location>GeoPoliticalEntity>City');

    //wrong values
    $wrongFormatOntoType = $response->getOntoType('dummy_value');
    $this->assertEmpty($wrongFormatOntoType);
    $wrongFormatArrayOntoType = $response->getOntoType(['dummy_key' => 'dummy_value']);
    $this->assertEmpty($wrongFormatArrayOntoType);
  }


  /**
   * @depends testConstruct
   * @depends testGetEntities
   * @depends testGetConcepts
   *
   * @param MCTopicsResponse $response
   */
  public function testGetTypeLastNode($response) {
    $firstEntityLastNode = $response->getTypeLastNode($response->getOntoType($response->getEntities()[0]));
    $this->assertNotEmpty($firstEntityLastNode);
    $this->assertEquals($firstEntityLastNode, 'City');

    $firstConceptLastNode = $response->getTypeLastNode($response->getOntoType($response->getConcepts()[0]));
    $this->assertNotEmpty($firstConceptLastNode);
    $this->assertEquals($firstConceptLastNode, 'City');

    //wrong values
    $wrongFormat = $response->getTypeLastNode('dummy_value');
    $this->assertEquals($wrongFormat, 'dummy_value');

    $wrongFormatArray = $response->getTypeLastNode(array('dummy_key' => 'dummy_value'));
    $this->assertEmpty($wrongFormatArray);
  }




  /**
   * @depends testConstruct
   * @depends testGetEntities
   * @depends testGetConcepts
   * @depends testGetTimeExpressions
   * @depends testGetMoneyExpressions
   * @depends testGetQuantityExpressions
   * @depends testGetOtherExpressions
   * @depends testGetQuotations
   * @depends testGetRelations
   *
   * @param MCTopicsResponse $response
   */
  public function testIsUserDefined($response) {

    $this->assertEquals($response->isUserDefined($response->getEntities()[0]),false);
    $this->assertEquals($response->isUserDefined($response->getConcepts()[0]), false);
    $this->assertEquals($response->isUserDefined($response->getTimeExpressions()[0]), false);
    $this->assertEquals($response->isUserDefined($response->getMoneyExpressions()[0]), false);
    $this->assertEquals($response->isUserDefined($response->getQuantityExpressions()[0]), false);
    $this->assertEquals($response->isUserDefined($response->getOtherExpressions()[0]), false);
    $this->assertEquals($response->isUserDefined($response->getQuotations()[0]), false);
    $this->assertEquals($response->isUserDefined($response->getRelations()[0]), false);

    $responseWithUserDefinedEntities = '{"status":{"code":"0","msg":"OK","credits":"1"},"entity_list":[{"form":"Lincoln Trikru","official_form":"Lincoln","dictionary":"test1","id":"ent_sin_tag","sementity":{"class":"instance","type":"Top&gt;People&gt;Grounders"},"variant_list":[{"form":"Lincoln","inip":"0","endp":"6"}],"relevance":"100"}],"concept_list":[{"form":"dropship","id":"concepto_sin_tag","dictionary":"test1","sementity":{"class":"class"},"variant_list":[{"form":"dropship","inip":"19","endp":"26"}],"relevance":"100"}]}';
    $responseWithUD = new MCTopicsResponse($responseWithUserDefinedEntities);
    $this->assertEquals($responseWithUD->isUserDefined($responseWithUD->getEntities()[0]),true);
    $this->assertEquals($responseWithUD->isUserDefined($responseWithUD->getConcepts()[0]),true);

  }

  /**
   * @depends testConstruct
   * @depends testGetEntities
   * @depends testGetConcepts
   * @depends testGetTimeExpressions
   * @depends testGetMoneyExpressions
   * @depends testGetQuantityExpressions
   * @depends testGetOtherExpressions
   * @depends testGetQuotations
   * @depends testGetRelations
   *
   * @param MCTopicsResponse $response
   */
  public function testGetNumberOfAppearances($response) {
    $this->assertEquals($response->getNumberOfAppearances($response->getEntities()[0]),"1");
    $this->assertEquals($response->getNumberOfAppearances($response->getConcepts()[0]), "1");
    $this->assertEquals($response->getNumberOfAppearances($response->getTimeExpressions()[0]), "1");
    $this->assertEquals($response->getNumberOfAppearances($response->getMoneyExpressions()[0]), "1");
    $this->assertEquals($response->getNumberOfAppearances($response->getQuantityExpressions()[0]), "1");
    $this->assertEquals($response->getNumberOfAppearances($response->getOtherExpressions()[0]), "1");
    $this->assertEquals($response->getNumberOfAppearances($response->getQuotations()[0]), "1");
    $this->assertEquals($response->getNumberOfAppearances($response->getRelations()[0]), "1");

    //wrong value
    $this->assertEquals($response->getNumberOfAppearances(NULL), "0");
  }

}