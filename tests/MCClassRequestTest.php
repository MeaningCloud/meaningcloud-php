<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 07/01/20
 */


namespace MeaningCloud;

use PHPUnit\Framework\TestCase;

class MCClassRequestTest extends TestCase {

  const SERVER = 'https://api.meaningcloud.com/';
  const URL = self::SERVER.'class-2.0';
  const KEY = 'MY_KEY';
  const TIMEOUT_DEFAULT = 60;
  const RESOURCES_DIR = __DIR__.'/resources/';
  const MODEL = 'IPTC_en';

  public function testConstruct() {
    $request = new MCClassRequest(self::KEY, self::MODEL);
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
    new MCClassRequest('', self::MODEL);

    $this->expectException(\Exception::class);
    new MCClassRequest(self::KEY, '');

    $this->expectException(\Exception::class);
    new MCClassRequest('', '');
  }


  public function testConstructWithTxt() {
    $txt = 'This is MeaningCloud\'s official PHP client';
    $request = new MCClassRequest(self::KEY, self::MODEL, $txt);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $this->assertEquals($txt, $params['txt']);
    return $request;
  }


  public function testConstructWithUrl() {
    $url = 'https://en.wikipedia.org/wiki/Star_Trek';
    $request = new MCClassRequest(self::KEY, self::MODEL, '', $url);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('url', $params);
    $this->assertEquals($url, $params['url']);
    return $request;
  }


  public function testConstructWithFile() {
    $file = self::RESOURCES_DIR.'file.txt';
    $request = new MCClassRequest(self::KEY, self::MODEL, '', '', $file);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('doc', $params);
    $this->assertInstanceOf( \CURLFile::class, $params['doc']);
    $doc = $params['doc'];
    $this->assertNotNull($doc->name);
    return $request;
  }

  /**
   * @depends testConstruct
   * @param MCClassRequest $request
   */
  public function testSendRequest($request) {
    $classResponse = $request->sendClassRequest();
    $this->assertNotNull($classResponse);
    $this->assertNotNull($classResponse->getResponse());
  }


  public function testSendRequestExtraHeaders() {
    $extraHeaders = ["Accept: application/json"];
    $request = new MCClassRequest(self::KEY, self::MODEL, '', '', '', [], $extraHeaders);
    $classResponse = $request->sendClassRequest();
    $this->assertNotNull($classResponse);
    $this->assertNotNull($classResponse->getResponse());
  }


  /**
   * @depends testConstructWithTxt
   * @param MCClassRequest $request
   */
  public function testSendRequestWithTxt($request) {
    $classResponse = $request->sendClassRequest();
    $this->assertNotNull($classResponse);
    $this->assertNotNull($classResponse->getResponse());
  }


  /**
   * @depends testConstructWithUrl
   * @param MCClassRequest $request
   */
  public function testSendRequestWithUrl($request) {
    $classResponse = $request->sendClassRequest();
    $this->assertNotNull($classResponse);
    $this->assertNotNull($classResponse->getResponse());
  }


  /**
   * @depends testConstructWithFile
   * @param MCClassRequest $request
   */
  public function testSendRequestWithFile($request) {
    $classResponse = $request->sendClassRequest();
    $this->assertNotNull($classResponse);
    $this->assertNotNull($classResponse->getResponse());
  }


}
