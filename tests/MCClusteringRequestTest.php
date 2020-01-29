<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */


namespace MeaningCloud;

use PHPUnit\Framework\TestCase;


class MCClusteringRequestTest extends TestCase {

  const SERVER = 'https://api.meaningcloud.com/';
  const URL = self::SERVER.'clustering-1.1';
  const KEY = 'MY_KEY';
  const TIMEOUT_DEFAULT = 60;
  const LANG = 'en';
  const RESOURCES_DIR = __DIR__.'/resources/';

  public function testConstruct() {
    $request = new MCClusteringRequest(self::KEY, self::LANG);
    $this->assertEquals(self::URL, $request->getUrl());
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('key', $params);
    $this->assertEquals(self::KEY, $params['key']);
    $this->assertNotEmpty($request->getTimeout());
    $this->assertEquals(self::TIMEOUT_DEFAULT, $request->getTimeout());
    return $request;
  }


  public function testConstructWithEmptyParams() {
    $this->expectException(\Exception::class);
    new MCClusteringRequest('', self::LANG);

    $this->expectException(\Exception::class);
    new MCClusteringRequest(self::KEY, '');

    $this->expectException(\Exception::class);
    new MCClusteringRequest('', '');
  }


  public function testConstructWithTexts() {
    $texts = ["A01" => "London is big", "A02" => "That city is fantastic"];
    $request = new MCClusteringRequest(self::KEY, self::LANG, $texts);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $strTexts = implode("\n", array_values($texts));
    $this->assertEquals($strTexts, $params['txt']);
    return $request;
  }


  public function testConstructWithTextsWithNoKeys() {
    $texts = ["London is big", "That city is fantastic"];
    $request = new MCClusteringRequest(self::KEY, self::LANG, $texts);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $this->assertNotEmpty($params['txt']);
    $this->assertNotEmpty($params['id']);
    $this->assertEquals(implode("\n", array_keys($texts)), $params['id']);
    return $request;
  }


  /**
   * @depends testConstruct
   * @param MCClusteringRequest $request
   */
  public function testSendRequest($request) {
    $clusteringResponse = $request->sendClusteringRequest();
    $this->assertNotNull($clusteringResponse);
    $this->assertNotNull($clusteringResponse->getResponse());
  }


  public function testSendRequestExtraHeaders() {
    $extraHeaders = ["Accept: application/json"];
    $request = new MCClusteringRequest(self::KEY, self::LANG, '', '', [], $extraHeaders);
    $clusteringResponse = $request->sendClusteringRequest();
    $this->assertNotNull($clusteringResponse);
    $this->assertNotNull($clusteringResponse->getResponse());
  }


  /**
   * @depends testConstructWithTexts
   * @param MCClusteringRequest $request
   */
  public function testSendRequestWithTxt($request) {
    $clusteringResponse = $request->sendClusteringRequest();
    $this->assertNotNull($clusteringResponse);
    $this->assertNotNull($clusteringResponse->getResponse());
  }

}
