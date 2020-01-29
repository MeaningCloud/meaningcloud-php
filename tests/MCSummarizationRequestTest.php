<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */


namespace MeaningCloud;

use PHPUnit\Framework\TestCase;


class MCSummarizationRequestTest extends TestCase {

  const SERVER = 'https://api.meaningcloud.com/';
  const URL = self::SERVER.'summarization-1.0';
  const KEY = 'MY_KEY';
  const TIMEOUT_DEFAULT = 60;
  const RESOURCES_DIR = __DIR__.'/resources/';

  public function testConstruct() {
    $request = new MCSummarizationRequest(self::KEY);
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
    new MCSummarizationRequest('');
  }

  public function testConstructWithTxt() {
    $txt = 'This is MeaningCloud\'s official PHP client';
    $request = new MCSummarizationRequest(self::KEY, $txt);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $this->assertEquals($txt, $params['txt']);
    return $request;
  }


  public function testConstructWithUrl() {
    $url = 'https://en.wikipedia.org/wiki/Star_Trek';
    $request = new MCSummarizationRequest(self::KEY, '', $url);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('url', $params);
    $this->assertEquals($url, $params['url']);
    return $request;
  }


  public function testConstructWithFile() {
    $file = self::RESOURCES_DIR.'file.txt';
    $request = new MCSummarizationRequest(self::KEY, '', '', $file);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('doc', $params);
    $this->assertInstanceOf( \CURLFile::class, $params['doc']);
    $doc = $params['doc'];
    $this->assertNotNull($doc->name);
    return $request;
  }


  public function testConstructWithSentences() {
    $sentences = 3;
    $request = new MCSummarizationRequest(self::KEY, '', '', '', $sentences);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('sentences', $params);
    $this->assertEquals($sentences, $params['sentences']);
  }


  /**
   * @depends testConstruct
   * @param MCSummarizationRequest $request
   */
  public function testSendRequest($request) {
    $summarizationResponse = $request->sendSummarizationRequest();
    $this->assertNotNull($summarizationResponse);
    $this->assertNotNull($summarizationResponse->getResponse());
  }


  public function testSendRequestExtraHeaders() {
    $extraHeaders = ["Accept: application/json"];
    $request = new MCSummarizationRequest(self::KEY, '', '', '', 5, [], $extraHeaders);
    $summarizationResponse = $request->sendSummarizationRequest();
    $this->assertNotNull($summarizationResponse);
    $this->assertNotNull($summarizationResponse->getResponse());
  }


  /**
   * @depends testConstructWithTxt
   * @param MCSummarizationRequest $request
   */
  public function testSendRequestWithTxt($request) {
    $summarizationResponse = $request->sendSummarizationRequest();
    $this->assertNotNull($summarizationResponse);
    $this->assertNotNull($summarizationResponse->getResponse());
  }


  /**
   * @depends testConstructWithUrl
   * @param MCSummarizationRequest $request
   */
  public function testSendRequestWithUrl($request) {
    $summarizationResponse = $request->sendSummarizationRequest();
    $this->assertNotNull($summarizationResponse);
    $this->assertNotNull($summarizationResponse->getResponse());
  }


  /**
   * @depends testConstructWithFile
   * @param MCSummarizationRequest $request
   */
  public function testSendRequestWithFile($request) {
    $summarizationResponse = $request->sendSummarizationRequest();
    $this->assertNotNull($summarizationResponse);
    $this->assertNotNull($summarizationResponse->getResponse());
  }

}
