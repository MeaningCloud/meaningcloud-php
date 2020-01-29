<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */

namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCSummarizationResponseTest extends TestCase {


  public function testConstruct() {
    $outputOK = '{"status": {"code": "0", "msg": "OK", "credits": "25"}, "summary": "Star Trek is an American science fiction media franchise based on the television series created by Gene Roddenberry. The first television series, simply called, Star Trek, and now referred to as The Original Series, debuted in 1966 and aired for three seasons on the television network NBC. The Star Trek canon of the franchise includes The Original Series, an animated series, four spin-off television series, its film franchise and an upcoming television series scheduled to debut in 2017. In creating Star Trek, Roddenberry was inspired by the Horatio Hornblower novels, the satirical book Gulliver\'s Travels, and by works of western genre such as the television series Wagon Train. Four spin-off television series were eventually produced: Star Trek: The Next Generation followed the crew of a new starship Enterprise set a century after the original series; Star Trek: Deep Space Nine and Star Trek: Voyager set contemporaneously with The Next Generation; and Star Trek: Enterprise set before the original series in the early days of human interstellar travel."}';
    $response = new MCSummarizationResponse($outputOK);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  public function testConstructWithWrongJson() {
    $outputWrong = 'malformed json';
    $response = new MCSummarizationResponse($outputWrong);
    $this->assertNull($response->getResponse());
    return $response;
  }


  public function testConstructWithEmptyParam() {
    $this->expectException(\Exception::class);
    new MCSummarizationResponse('');
  }


  public function testConstructEmptyResult() {
    $outputEmpty = '{"status": {"code": "0","msg": "OK","credits": "1","remaining_credits":"5000"}}';
    $response = new MCSummarizationResponse($outputEmpty);
    $this->assertNotNull($response->getResponse());
    return $response;
  }


  /**
   * @depends testConstruct
   * @param MCSummarizationResponse $response
   */
  public function testGetSummary($response) {
    $this->assertNotEmpty($response->getSummary());
    $this->assertTrue(is_string($response->getSummary()));
  }


  /**
   * @depends testConstructEmptyResult
   * @param MCSummarizationResponse $response
   */
  public function testGetNonexistentSummary($response) {
    $this->assertEmpty($response->getSummary());
  }

}
