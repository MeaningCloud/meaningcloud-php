<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 07/01/20
 */


namespace MeaningCloud;

use PHPUnit\Framework\TestCase;


class MCDeepCategorizationRequestTest extends TestCase {

  const SERVER = 'https://api.meaningcloud.com/';
  const URL = self::SERVER.'deepcategorization-1.0';
  const KEY = 'MY_KEY';
  const TIMEOUT_DEFAULT = 60;
  const RESOURCES_DIR = __DIR__.'/resources/';
  const MODEL = 'IAB_2.0_en';

  public function testConstruct() {
    $request = new MCDeepCategorizationRequest(self::KEY, self::MODEL);
    $this->assertEquals(self::URL, $request->getUrl());
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('key', $params);
    $this->assertEquals(self::KEY, $params['key']);
    $this->assertArrayHasKey('model', $params);
    $this->assertEquals(self::MODEL, $params['model']);
    $this->assertNotEmpty($request->getTimeout());
    $this->assertEquals(self::TIMEOUT_DEFAULT, $request->getTimeout());
    return $request;
  }


  public function testConstructWithEmptyParams() {
    $this->expectException(\Exception::class);
    new MCDeepCategorizationRequest('', self::MODEL);

    $this->expectException(\Exception::class);
    new MCDeepCategorizationRequest(self::KEY, '');

    $this->expectException(\Exception::class);
    new MCDeepCategorizationRequest('', '');
  }


  public function testConstructWithTxt() {
    $txt = 'This is MeaningCloud\'s official PHP client';
    $request = new MCDeepCategorizationRequest(self::KEY, self::MODEL, $txt);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $this->assertEquals($txt, $params['txt']);
    return $request;
  }


  public function testConstructWithUrl() {
    $url = 'https://en.wikipedia.org/wiki/Star_Trek';
    $request = new MCDeepCategorizationRequest(self::KEY, self::MODEL, '', $url);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('url', $params);
    $this->assertEquals($url, $params['url']);
    return $request;
  }


  public function testConstructWithFile() {
    $file = self::RESOURCES_DIR.'file.txt';
    $request = new MCDeepCategorizationRequest(self::KEY, self::MODEL, '', '', $file);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('doc', $params);
    $this->assertInstanceOf( \CURLFile::class, $params['doc']);
    $doc = $params['doc'];
    $this->assertNotNull($doc->name);
    return $request;
  }


  public function testConstructWithPolarityYes() {
    $txt = 'This is MeaningCloud\'s official PHP client';
    $polarity = 'y';
    $request = new MCDeepCategorizationRequest(self::KEY, self::MODEL, $txt, '', '', $polarity);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('polarity', $params);
    $this->assertEquals($polarity, $params['polarity']);
    return $request;
  }


  /**
   * @depends testConstruct
   * @param MCDeepCategorizationRequest $request
   */
  public function testSendRequest($request) {
    $deepResponse = $request->sendDeepCategorizationRequest();
    $this->assertNotNull($deepResponse);
    $this->assertNotNull($deepResponse->getResponse());
  }


  public function testSendRequestExtraHeaders() {
    $extraHeaders = ["Accept: application/json"];
    $request = new MCDeepCategorizationRequest(self::KEY, self::MODEL, '', '', '', 'n', [], $extraHeaders);
    $deepResponse = $request->sendDeepCategorizationRequest();
    $this->assertNotNull($deepResponse);
    $this->assertNotNull($deepResponse->getResponse());
  }


  /**
   * @depends testConstructWithTxt
   * @param MCDeepCategorizationRequest $request
   */
  public function testSendRequestWithTxt($request) {
    $deepResponse = $request->sendDeepCategorizationRequest();
    $this->assertNotNull($deepResponse);
    $this->assertNotNull($deepResponse->getResponse());
  }


  /**
   * @depends testConstructWithUrl
   * @param MCDeepCategorizationRequest $request
   */
  public function testSendRequestWithUrl($request) {
    $deepResponse = $request->sendDeepCategorizationRequest();
    $this->assertNotNull($deepResponse);
    $this->assertNotNull($deepResponse->getResponse());
  }


  /**
   * @depends testConstructWithFile
   * @param MCDeepCategorizationRequest $request
   */
  public function testSendRequestWithFile($request) {
    $deepResponse = $request->sendDeepCategorizationRequest();
    $this->assertNotNull($deepResponse);
    $this->assertNotNull($deepResponse->getResponse());
  }


  /**
   * @depends testConstructWithPolarityYes
   * @param MCDeepCategorizationRequest $request
   */
  public function testSendRequestWithPolarityYes($request) {
    $deepResponse = $request->sendDeepCategorizationRequest();
    $this->assertNotNull($deepResponse);
    $this->assertNotNull($deepResponse->getResponse());
  }

}
