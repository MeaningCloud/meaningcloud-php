<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 28/12/17
 */


namespace MeaningCloud;

use PHPUnit\Framework\TestCase;


class MCRequestTest extends TestCase {

  const SERVER = 'https://api.meaningcloud.com/';
  const URL = self::SERVER.'lang-2.0';
  const KEY = 'MY_KEY';
  const TIMEOUT_DEFAULT = 60;
  const RESOURCES_DIR = __DIR__.'/resources/';

  public function testConstruct() {
    $request = new MCRequest(self::URL, self::KEY);
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
    new MCRequest('', '');

    $this->expectException(\Exception::class);
    new MCRequest(self::URL, '');

    $this->expectException(\Exception::class);
    new MCRequest('', self::KEY);
  }


  /**
   * @depends testConstruct
   * @param MCRequest $request
   * @return MCRequest
   */
  public function testAddParam($request) {
    $request->addParam('lang', 'en');
    $params = $request->getParams();
    $this->assertArrayHasKey('lang', $params);
    $this->assertEquals('en', $params['lang']);

    $request->addParam('of', 'json');
    $params = $request->getParams();
    $this->assertArrayHasKey('of', $params);
    $this->assertEquals('json', $params['of']);
    return $request;
  }


  /**
   * @depends testConstruct
   * @param MCRequest $request
   */
  public function testAddParamWithEmptyName($request) {
    $this->expectException(\Exception::class);
    $request->addParam('', 'en');
  }


  /**
   * @depends testAddParam
   * @param MCRequest $request
   */
  public function testSetContentTxt($request) {
    $txt = 'This is MeaningCloud\'s official PHP client';
    $request->setContentTxt($txt);
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $this->assertEquals($txt, $params['txt']);
  }


  /**
   * @depends testAddParam
   * @param MCRequest $request
   */
  public function testSetContentUrl($request) {
    $url = 'https://en.wikipedia.org/wiki/Star_Trek';
    $request->setContentUrl($url);
    $params = $request->getParams();
    $this->assertArrayHasKey('url', $params);
    $this->assertEquals($url, $params['url']);
  }


  /**
   * @depends testAddParam
   * @param MCRequest $request
   */
  public function testSetContentFile($request) {
    $file = self::RESOURCES_DIR.'file.txt';
    $request->setContentFile($file);
    $params = $request->getParams();
    $this->assertArrayHasKey('doc', $params);
    $this->assertInstanceOf( \CURLFile::class, $params['doc']);
    $doc = $params['doc'];
    $this->assertNotNull($doc->name);
  }


  /**
   * @depends testConstruct
   * @param MCRequest $request
   */
  public function testSetTimeout($request) {
    $timeout = 360;
    $request->setTimeout($timeout);
    $this->assertEquals($timeout, $request->getTimeout());
  }


  /**
   * @depends testConstruct
   * @param MCRequest $request
   */
  public function testSendRequest($request) {
    $strResponse = $request->sendRequest();
    $response = new MCResponse($strResponse);
    $this->assertNotNull($response);
    $this->assertNotNull($response->getResponse());
  }


  /**
   * @depends testConstruct
   * @param MCRequest $request
   */
  public function testSendRequestExtraHeaders($request) {
    $extraHeaders = ["Accept: application/json"];
    $strResponse = $request->sendRequest($extraHeaders);
    $response = new MCResponse($strResponse);
    $this->assertNotNull($response);
    $this->assertNotNull($response->getResponse());
  }


  /**
   * @depends testConstruct
   * @param MCRequest $request
   */
  public function testSetURL($request) {
    $url = 'https://myinstance.meaningcloud.com';
    $request->setURL($url);
    $this->assertEquals($url, $request->getUrl());
  }

}
