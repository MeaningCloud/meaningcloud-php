<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 23/03/18
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCParserResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status":{"code":"0","msg":"OK","credits":"1"},"token_list":[{"type":"sentence","id":"8","inip":"0","endp":"21","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"A","quote_level":"0","affected_by_negation":"no","token_list":[{"type":"phrase","form":"London is a nice city","id":"12","inip":"0","endp":"20","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"_","quote_level":"0","affected_by_negation":"no","analysis_list":[{"tag":"Z-----------","lemma":"*","original_form":"London is a nice city"}],"topic_list":{"relation_list":[{"form":"London is a nice city.","inip":"0","endp":"20","subject":{"form":"London","lemma_list":["London"],"sense_id_list":["01d0d69c7d","76075d4877"]},"verb":{"form":"is","lemma_list":["be"]},"complement_list":[{"form":"a nice city","type":"isAttribute"}],"degree":"1"}]},"token_list":[{"type":"phrase","form":"London","id":"10","inip":"0","endp":"5","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"_","quote_level":"0","affected_by_negation":"no","head":"1","syntactic_tree_relation_list":[{"id":"2","type":"isSubject"}],"analysis_list":[{"tag":"GN-S3S--","lemma":"London","original_form":"London"},{"tag":"GNUS3S--","lemma":"London","original_form":"London"}],"token_list":[{"form":"London","id":"1","inip":"0","endp":"5","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"_","quote_level":"0","affected_by_negation":"no","analysis_list":[{"tag":"NP-S-N-","lemma":"London","original_form":"London","sense_id_list":[{"sense_id":"01d0d69c7d"}]},{"tag":"NPUU-N-","lemma":"London","original_form":"London","sense_id_list":[{"sense_id":"76075d4877"}]}],"sense_list":[{"id":"01d0d69c7d","form":"London","info":"sementity/class=instance@fiction=nonfiction@id=ODENTITY_CITY@type=Top>Location>GeoPoliticalEntity>City\tsemgeo_list/adm1=England#id:98db781864@adm2=Greater London#id:ed00f6dec4@continent=Europe#id:0404ea4d6c@country=United Kingdom#id:d29f412b4b#ISO3166-1-a2:GB#ISO3166-1-a3:GBR\tsemld_list=http://en.wikipedia.org/wiki/London|http://ar.wikipedia.org/wiki/لندن|http://ca.wikipedia.org/wiki/Londres|http://cs.wikipedia.org/wiki/Londýn|http://da.wikipedia.org/wiki/London|http://de.wikipedia.org/wiki/London|http://es.wikipedia.org/wiki/Londres|http://fi.wikipedia.org/wiki/Lontoo|http://fr.wikipedia.org/wiki/Londres|http://he.wikipedia.org/wiki/לונדון|http://hi.wikipedia.org/wiki/लंदन|http://id.wikipedia.org/wiki/London|http://it.wikipedia.org/wiki/Londra|http://ja.wikipedia.org/wiki/ロンドン|http://ko.wikipedia.org/wiki/런던|http://nl.wikipedia.org/wiki/Londen|http://no.wikipedia.org/wiki/London|http://pl.wikipedia.org/wiki/Londyn|http://pt.wikipedia.org/wiki/Londres|http://ro.wikipedia.org/wiki/Londra|http://ru.wikipedia.org/wiki/Лондон|http://sv.wikipedia.org/wiki/London|http://th.wikipedia.org/wiki/ลอนดอน|http://tr.wikipedia.org/wiki/Londra|http://zh.wikipedia.org/wiki/伦敦|http://d-nb.info/gnd/4074335-4|http://linkedgeodata.org/triplify/node107775|http://linked-web-apis.fit.cvut.cz/resource/london_city|http://linked-web-apis.fit.cvut.cz/resource/london_uk_city|http://data.nytimes.com/14085781296239331901|http://sw.cyc.com/concept/Mx4rvVjWPJwpEbGdrcN5Y29ycA|http://umbel.org/umbel/rc/Location_Underspecified|http://umbel.org/umbel/rc/PopulatedPlace|http://umbel.org/umbel/rc/Village|http://sws.geonames.org/2643743/|@BBCLondres2012|@LDN|@OlimpicoCaracol|@TelevisaLondres|@TimeOutLondon|@visitlondon|sumo:City"},{"id":"76075d4877","form":"London","info":"sementity/class=instance@fiction=nonfiction@id=ODENTITY_LAST_NAME@type=Top>Person>LastName\tsemld_list=sumo:LastName"}],"topic_list":{"entity_list":[{"form":"London","id":"01d0d69c7d","sementity":{"class":"instance","fiction":"nonfiction","id":"ODENTITY_CITY","type":"Top>Location>GeoPoliticalEntity>City"},"semgeo_list":[{"adm1":{"form":"England","id":"98db781864"},"adm2":{"form":"Greater London","id":"ed00f6dec4"},"continent":{"form":"Europe","id":"0404ea4d6c"},"country":{"form":"United Kingdom","id":"d29f412b4b","standard_list":[{"id":"ISO3166-1-a2","value":"GB"},{"id":"ISO3166-1-a3","value":"GBR"}]}}],"semld_list":["http://en.wikipedia.org/wiki/London","http://ar.wikipedia.org/wiki/لندن","http://ca.wikipedia.org/wiki/Londres","http://cs.wikipedia.org/wiki/Londýn","http://da.wikipedia.org/wiki/London","http://de.wikipedia.org/wiki/London","http://es.wikipedia.org/wiki/Londres","http://fi.wikipedia.org/wiki/Lontoo","http://fr.wikipedia.org/wiki/Londres","http://he.wikipedia.org/wiki/לונדון","http://hi.wikipedia.org/wiki/लंदन","http://id.wikipedia.org/wiki/London","http://it.wikipedia.org/wiki/Londra","http://ja.wikipedia.org/wiki/ロンドン","http://ko.wikipedia.org/wiki/런던","http://nl.wikipedia.org/wiki/Londen","http://no.wikipedia.org/wiki/London","http://pl.wikipedia.org/wiki/Londyn","http://pt.wikipedia.org/wiki/Londres","http://ro.wikipedia.org/wiki/Londra","http://ru.wikipedia.org/wiki/Лондон","http://sv.wikipedia.org/wiki/London","http://th.wikipedia.org/wiki/ลอนดอน","http://tr.wikipedia.org/wiki/Londra","http://zh.wikipedia.org/wiki/伦敦","http://d-nb.info/gnd/4074335-4","http://linkedgeodata.org/triplify/node107775","http://linked-web-apis.fit.cvut.cz/resource/london_city","http://linked-web-apis.fit.cvut.cz/resource/london_uk_city","http://data.nytimes.com/14085781296239331901","http://sw.cyc.com/concept/Mx4rvVjWPJwpEbGdrcN5Y29ycA","http://umbel.org/umbel/rc/Location_Underspecified","http://umbel.org/umbel/rc/PopulatedPlace","http://umbel.org/umbel/rc/Village","http://sws.geonames.org/2643743/","@BBCLondres2012","@LDN","@OlimpicoCaracol","@TelevisaLondres","@TimeOutLondon","@visitlondon","sumo:City"]},{"form":"London","id":"76075d4877","sementity":{"class":"instance","fiction":"nonfiction","id":"ODENTITY_LAST_NAME","type":"Top>Person>LastName"},"semld_list":["sumo:LastName"]}]}}]},{"form":"is","id":"2","inip":"7","endp":"8","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"1","quote_level":"0","affected_by_negation":"no","syntactic_tree_relation_list":[{"id":"10","type":"iof_isSubject"},{"id":"11","type":"iof_isAttribute"}],"analysis_list":[{"tag":"VI-S3PSA-N-N9","lemma":"be","original_form":"is"}]},{"type":"phrase","form":"a nice city","id":"11","inip":"10","endp":"20","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"1","quote_level":"0","affected_by_negation":"no","head":"5","syntactic_tree_relation_list":[{"id":"2","type":"isAttribute"}],"analysis_list":[{"tag":"GN-S3A--","lemma":"city","original_form":"a nice city"}],"token_list":[{"form":"a","id":"3","inip":"10","endp":"10","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"1","quote_level":"0","affected_by_negation":"no","analysis_list":[{"tag":"QD-SPN9","lemma":"a","original_form":"a"}]},{"form":"nice","id":"4","inip":"12","endp":"15","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"1","quote_level":"0","affected_by_negation":"no","analysis_list":[{"tag":"AP-N6","lemma":"nice","original_form":"nice"}]},{"form":"city","id":"5","inip":"17","endp":"20","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"1","quote_level":"0","affected_by_negation":"no","analysis_list":[{"tag":"NC-S-N6","lemma":"city","original_form":"city","sense_id_list":[{"sense_id":"817857ee40"}]}],"sense_list":[{"id":"817857ee40","form":"city","info":"sementity/class=class@fiction=nonfiction@id=ODENTITY_CITY@type=Top>Location>GeoPoliticalEntity>City\tsemld_list=http://en.wikipedia.org/wiki/City|http://ar.wikipedia.org/wiki/مدينة|http://ca.wikipedia.org/wiki/Ciutat|http://cs.wikipedia.org/wiki/Město|http://de.wikipedia.org/wiki/Stadt|http://es.wikipedia.org/wiki/Ciudad|http://fi.wikipedia.org/wiki/Kaupunki|http://fr.wikipedia.org/wiki/Ville|http://he.wikipedia.org/wiki/עיר|http://hi.wikipedia.org/wiki/शहर|http://id.wikipedia.org/wiki/Kota|http://it.wikipedia.org/wiki/Città|http://ja.wikipedia.org/wiki/都市|http://ko.wikipedia.org/wiki/도시|http://nl.wikipedia.org/wiki/Stad|http://no.wikipedia.org/wiki/By|http://pl.wikipedia.org/wiki/Miasto|http://pt.wikipedia.org/wiki/Cidade|http://ro.wikipedia.org/wiki/Oraș|http://ru.wikipedia.org/wiki/Город|http://sv.wikipedia.org/wiki/Stad|http://th.wikipedia.org/wiki/นคร|http://tr.wikipedia.org/wiki/Şehir|http://zh.wikipedia.org/wiki/城市|http://d-nb.info/gnd/4056723-0|sumo:City"}],"topic_list":{"concept_list":[{"form":"city","id":"817857ee40","sementity":{"class":"class","fiction":"nonfiction","id":"ODENTITY_CITY","type":"Top>Location>GeoPoliticalEntity>City"},"semld_list":["http://en.wikipedia.org/wiki/City","http://ar.wikipedia.org/wiki/مدينة","http://ca.wikipedia.org/wiki/Ciutat","http://cs.wikipedia.org/wiki/Město","http://de.wikipedia.org/wiki/Stadt","http://es.wikipedia.org/wiki/Ciudad","http://fi.wikipedia.org/wiki/Kaupunki","http://fr.wikipedia.org/wiki/Ville","http://he.wikipedia.org/wiki/עיר","http://hi.wikipedia.org/wiki/शहर","http://id.wikipedia.org/wiki/Kota","http://it.wikipedia.org/wiki/Città","http://ja.wikipedia.org/wiki/都市","http://ko.wikipedia.org/wiki/도시","http://nl.wikipedia.org/wiki/Stad","http://no.wikipedia.org/wiki/By","http://pl.wikipedia.org/wiki/Miasto","http://pt.wikipedia.org/wiki/Cidade","http://ro.wikipedia.org/wiki/Oraș","http://ru.wikipedia.org/wiki/Город","http://sv.wikipedia.org/wiki/Stad","http://th.wikipedia.org/wiki/นคร","http://tr.wikipedia.org/wiki/Şehir","http://zh.wikipedia.org/wiki/城市","http://d-nb.info/gnd/4056723-0","sumo:City"]}]}}]}]},{"form":".","id":"6","inip":"21","endp":"21","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"A","quote_level":"0","affected_by_negation":"no","analysis_list":[{"tag":"1D--","lemma":".","original_form":"."}]}]}]}';
    $response = new MCParserResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCParserResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCParserResponse('');
  }


  /**
   * @depends testConstruct
   *
   * @param MCParserResponse $response
   */
  public function testGetLemmatization($response) {
    $expectedResult = '[[{"form":"London","lemma":"London","pos":"NP"}],[{"form":"is","lemma":"be","pos":"VI"}],[{"form":"a","lemma":"a","pos":"QD"}],[{"form":"nice","lemma":"nice","pos":"AP"}],[{"form":"city","lemma":"city","pos":"NC"}],[{"form":".","lemma":".","pos":"1D"}]]';
    $lemmas = $response->getLemmatization();
    $this->assertNotEmpty($lemmas);
    //London is a nice city
    $this->assertTrue(is_array($lemmas), 'The output is not an array');
    $this->assertEquals($expectedResult, json_encode($lemmas));
  }

  /**
   * @depends testConstruct
   *
   * @param MCParserResponse $response
   */
  public function testGetCompleteLemmatization($response) {
    $expectedResult = '[[{"form":"London","lemma":"London","pos":"NP-S-N-"},{"form":"London","lemma":"London","pos":"NPUU-N-"}],[{"form":"is","lemma":"be","pos":"VI-S3PSA-N-N9"}],[{"form":"a","lemma":"a","pos":"QD-SPN9"}],[{"form":"nice","lemma":"nice","pos":"AP-N6"}],[{"form":"city","lemma":"city","pos":"NC-S-N6"}],[{"form":".","lemma":".","pos":"1D--"}]]';
    $lemmas = $response->getLemmatization(true);
    $this->assertNotEmpty($lemmas, "Lemmas is empty");
    //London is a nice city
    $this->assertTrue(is_array($lemmas), 'The output is not an array');
    $this->assertEquals($expectedResult, json_encode($lemmas));
  }


   /**
   * @depends testConstruct
   * @dataProvider booleanProvider
   * @param MCParserResponse $response
   */
  public function testGetNonexistentLemmatization($completeTag) {
    $responseWithNoLemmas = '{"status":{"code":"0","msg":"OK","credits":"1"},"token_list":[{"type":"sentence","id":"3","inip":"0","endp":"7","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"A","quote_level":"0","affected_by_negation":"no","token_list":[{"type":"phrase","form":"ajsahdsa","id":"5","inip":"0","endp":"7","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"_","quote_level":"0","affected_by_negation":"no","analysis_list":[{"tag":"Z-----------","lemma":"*","original_form":"ajsahdsa"}],"token_list":[{"form":"ajsahdsa","id":"1","inip":"0","endp":"7","style":{"isBold":"no","isItalics":"no","isUnderlined":"no","isTitle":"no"},"separation":"_","quote_level":"0","affected_by_negation":"no"}]}]}]}';

    $responseWithNoLemmas = new MCParserResponse($responseWithNoLemmas);
    $lemmas = $responseWithNoLemmas->getLemmatization($completeTag);
    $this->assertNotEmpty($lemmas, "Lemmas is empty");
    $this->assertTrue(is_array($lemmas), 'The output is not an array');
    $this->assertEquals('[["ajsahdsa","",""]]', json_encode($lemmas));
  }


  /** Providers */
  public function booleanProvider() {
    return array(
      array('true'),
      array('false')
    );
  }

}
