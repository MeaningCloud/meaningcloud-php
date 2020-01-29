<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 30/12/19
 */


namespace MeaningCloud;

use PHPUnit\Framework\TestCase;


class MCLangRequestTest extends TestCase {

  const SERVER = 'https://api.meaningcloud.com/';
  const URL = self::SERVER.'lang-2.0';
  const KEY = 'MY_KEY';
  const TIMEOUT_DEFAULT = 60;
  const RESOURCES_DIR = __DIR__.'/resources/';

  public function testConstruct() {
    $request = new MCLangRequest(self::KEY);
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
    new MCLangRequest('');
  }


  public function testConstructWithTxt() {
    $txt = 'This is MeaningCloud\'s official PHP client';
    $request = new MCLangRequest(self::KEY, $txt);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $this->assertEquals($txt, $params['txt']);
    return $request;
  }


  public function testConstructWithUrl() {
    $url = 'https://en.wikipedia.org/wiki/Star_Trek';
    $request = new MCLangRequest(self::KEY, '', $url);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('url', $params);
    $this->assertEquals($url, $params['url']);
    return $request;
  }


  public function testConstructWithFile() {
    $file = self::RESOURCES_DIR.'file.txt';
    $request = new MCLangRequest(self::KEY, '', '', $file);
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
   * @param MCLangRequest $request
   */
  public function testSendRequest($request) {
    $langResponse = $request->sendLangRequest();
    $this->assertNotNull($langResponse);
    $this->assertNotNull($langResponse->getResponse());
  }


  public function testSendRequestExtraHeaders() {
    $extraHeaders = ["Accept: application/json"];
    $request = new MCLangRequest(self::KEY, '', '', '', [], $extraHeaders);
    $langResponse = $request->sendLangRequest();
    $this->assertNotNull($langResponse);
    $this->assertNotNull($langResponse->getResponse());
  }


  /**
   * @depends testConstructWithTxt
   * @param MCLangRequest $request
   */
  public function testSendRequestWithTxt($request) {
    $langResponse = $request->sendLangRequest();
    $this->assertNotNull($langResponse);
    $this->assertNotNull($langResponse->getResponse());
  }


  /**
   * @depends testConstructWithUrl
   * @param MCLangRequest $request
   */
  public function testSendRequestWithUrl($request) {
    $langResponse = $request->sendLangRequest();
    $this->assertNotNull($langResponse);
    $this->assertNotNull($langResponse->getResponse());
  }


  /**
   * @depends testConstructWithFile
   * @param MCLangRequest $request
   */
  public function testSendRequestWithFile($request) {
    $langResponse = $request->sendLangRequest();
    $this->assertNotNull($langResponse);
    $this->assertNotNull($langResponse->getResponse());
  }

}
