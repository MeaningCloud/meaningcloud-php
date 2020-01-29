<?php
/**
 * Created by MeaningCloud Support Team.
 * Date: 08/01/20
 */


namespace MeaningCloud;

use PHPUnit\Framework\TestCase;


class MCParserRequestTest extends TestCase {

  const SERVER = 'https://api.meaningcloud.com/';
  const URL = self::SERVER.'parser-2.0';
  const KEY = 'MY_KEY';
  const TIMEOUT_DEFAULT = 60;
  const RESOURCES_DIR = __DIR__.'/resources/';
  const LANG = 'en';

  public function testConstruct() {
    $request = new MCParserRequest(self::KEY, self::LANG);
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
    new MCParserRequest('', self::LANG);

    $this->expectException(\Exception::class);
    new MCParserRequest(self::KEY, '');

    $this->expectException(\Exception::class);
    new MCParserRequest('', '');
  }


  public function testConstructWithTxt() {
    $txt = 'This is MeaningCloud\'s official PHP client';
    $request = new MCParserRequest(self::KEY, self::LANG, $txt);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('txt', $params);
    $this->assertEquals($txt, $params['txt']);
    return $request;
  }


  public function testConstructWithUrl() {
    $url = 'https://en.wikipedia.org/wiki/Star_Trek';
    $request = new MCParserRequest(self::KEY, self::LANG, '', $url);
    $this->assertNotEmpty($request->getParams());
    $params = $request->getParams();
    $this->assertArrayHasKey('url', $params);
    $this->assertEquals($url, $params['url']);
    return $request;
  }


  public function testConstructWithFile() {
    $file = self::RESOURCES_DIR.'file.txt';
    $request = new MCParserRequest(self::KEY, self::LANG, '', '', $file);
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
   * @param MCParserRequest $request
   */
  public function testSendRequest($request) {
    $parserResponse = $request->sendParserRequest();
    $this->assertNotNull($parserResponse);
    $this->assertNotNull($parserResponse->getResponse());
  }


  public function testSendRequestExtraHeaders() {
    $extraHeaders = ["Accept: application/json"];
    $request = new MCParserRequest(self::KEY, self::LANG, '', '', '', [], $extraHeaders);
    $parserResponse = $request->sendParserRequest();
    $this->assertNotNull($parserResponse);
    $this->assertNotNull($parserResponse->getResponse());
  }


  /**
   * @depends testConstructWithTxt
   * @param MCParserRequest $request
   */
  public function testSendRequestWithTxt($request) {
    $parserResponse = $request->sendParserRequest();
    $this->assertNotNull($parserResponse);
    $this->assertNotNull($parserResponse->getResponse());
  }


  /**
   * @depends testConstructWithUrl
   * @param MCParserRequest $request
   */
  public function testSendRequestWithUrl($request) {
    $parserResponse = $request->sendParserRequest();
    $this->assertNotNull($parserResponse);
    $this->assertNotNull($parserResponse->getResponse());
  }


  /**
   * @depends testConstructWithFile
   * @param MCParserRequest $request
   */
  public function testSendRequestWithFile($request) {
    $parserResponse = $request->sendParserRequest();
    $this->assertNotNull($parserResponse);
    $this->assertNotNull($parserResponse->getResponse());
  }

}
