<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 07/01/20
 */


namespace MeaningCloud;

use PHPUnit\Framework\TestCase;


class MCTopicsRequestTest extends TestCase {

  const SERVER = 'https://api.meaningcloud.com/';
  const URL = self::SERVER.'topics-2.0';
  const KEY = 'MY_KEY';
  const TIMEOUT_DEFAULT = 60;
  const RESOURCES_DIR = __DIR__.'/resources/';
  const LANG = 'en';

  public function testConstruct() {
    $request = new MCTopicsRequest(self::KEY, self::LANG);
    $this->assertEquals(self::URL, $request->getUrl());
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('key', $params);
    $this->assertEquals(self::KEY, $params['key']);
    $this->assertArrayHasKey('lang', $params);
    $this->assertEquals(self::LANG, $params['lang']);
    $this->assertNotEmpty($request->getTimeout());
    $this->assertEquals(self::TIMEOUT_DEFAULT, $request->getTimeout());
    return $request;
  }


  public function testConstructWithEmptyParams() {
    $this->expectException(\Exception::class);
    new MCTopicsRequest('', self::LANG);

    $this->expectException(\Exception::class);
    new MCTopicsRequest(self::KEY, '');

    $this->expectException(\Exception::class);
    new MCTopicsRequest('', '');
  }


  public function testConstructWithTxt() {
    $txt = 'This is MeaningCloud\'s official PHP client';
    $request = new MCTopicsRequest(self::KEY, self::LANG, $txt);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $this->assertEquals($txt, $params['txt']);
    return $request;
  }


  public function testConstructWithUrl() {
    $url = 'https://en.wikipedia.org/wiki/Star_Trek';
    $request = new MCTopicsRequest(self::KEY, self::LANG, '', $url);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('url', $params);
    $this->assertEquals($url, $params['url']);
    return $request;
  }


  public function testConstructWithFile() {
    $file = self::RESOURCES_DIR.'file.txt';
    $request = new MCTopicsRequest(self::KEY, self::LANG, '', '', $file);
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
   * @param MCTopicsRequest $request
   */
  public function testSendRequest($request) {
    $topicsResponse = $request->sendTopicsRequest();
    $this->assertNotNull($topicsResponse);
    $this->assertNotNull($topicsResponse->getResponse());
  }


  public function testSendRequestExtraHeaders() {
    $extraHeaders = ["Accept: application/json"];
    $request = new MCTopicsRequest(self::KEY, self::LANG, '', '', '', "a", [], $extraHeaders);
    $topicsResponse = $request->sendTopicsRequest();
    $this->assertNotNull($topicsResponse);
    $this->assertNotNull($topicsResponse->getResponse());
  }


  /**
   * @depends testConstructWithTxt
   * @param MCTopicsRequest $request
   */
  public function testSendRequestWithTxt($request) {
    $topicsResponse = $request->sendTopicsRequest();
    $this->assertNotNull($topicsResponse);
    $this->assertNotNull($topicsResponse->getResponse());
  }


  /**
   * @depends testConstructWithUrl
   * @param MCTopicsRequest $request
   */
  public function testSendRequestWithUrl($request) {
    $topicsResponse = $request->sendTopicsRequest();
    $this->assertNotNull($topicsResponse);
    $this->assertNotNull($topicsResponse->getResponse());
  }


  /**
   * @depends testConstructWithFile
   * @param MCTopicsRequest $request
   */
  public function testSendRequestWithFile($request) {
    $topicsResponse = $request->sendTopicsRequest();
    $this->assertNotNull($topicsResponse);
    $this->assertNotNull($topicsResponse->getResponse());
  }

}
