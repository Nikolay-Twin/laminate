<?php

namespace http\tests;

include __DIR__ .'/../vendor/autoload.php';

use http\Http;
use http\Uri;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = (new Http)->newRequest();
    }

    public function testCallingSetUriSetsUriInRequestAndOriginalRequestInClone()
    {
        $url = 'http://example.com/foo';
        $request = $this->request->withUri(new Uri($url));
        $this->assertNotSame($this->request, $request);
        $this->assertSame($url, (string) $request->getUri());
    }

//    public function testConstructorSetsOriginalRequestIfNoneProvided()
//    {
//        $url = 'http://example.com/foo';
//        $baseRequest = new PsrRequest([], [], $url, 'GET', 'php://memory');
//
//        $request = new Request($baseRequest);
//        $this->assertSame($baseRequest, $request->getOriginalRequest());
//    }
//
//    public function testCallingSettersRetainsOriginalRequest()
//    {
//        $url = 'http://example.com/foo';
//        $baseRequest = new PsrRequest([], [], $url, 'GET', 'php://memory');
//
//        $request = new Request($baseRequest);
//        $request = $request->withMethod('POST');
//        $new     = $request->withAddedHeader('X-Foo', 'Bar');
//
//        $this->assertNotSame($request, $new);
//        $this->assertNotSame($baseRequest, $new);
//        $this->assertNotSame($baseRequest, $new->getCurrentRequest());
//        $this->assertSame($baseRequest, $new->getOriginalRequest());
//    }
//
//    public function testCanAccessOriginalRequest()
//    {
//        $this->assertSame($this->original, $this->request->getOriginalRequest());
//    }
//
//    public function testDecoratorProxiesToAllMethods()
//    {
//        $stream = $this->getMock('Psr\Http\Message\StreamInterface');
//        $psrRequest = new PsrRequest([], [], 'http://example.com', 'POST', $stream, [
//            'Accept' => 'application/xml',
//            'X-URL' => 'http://example.com/foo',
//        ]);
//        $request = new Request($psrRequest);
//
//        $this->assertEquals('1.1', $request->getProtocolVersion());
//        $this->assertSame($stream, $request->getBody());
//        $this->assertSame($psrRequest->getHeaders(), $request->getHeaders());
//        $this->assertEquals($psrRequest->getRequestTarget(), $request->getRequestTarget());
//    }
}
