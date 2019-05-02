<?php

namespace Omnipay\Dotpay\Message;

use Omnipay\Tests\TestCase;

class RequestTest extends TestCase
{
    public function testConstruct()
    {
        $request = new Request($this->getHttpClient(), $this->getHttpRequest());

        $request->setAccountId(123456);
        $request->setType(100);
        $request->setAmount(10.00);
        $request->setLang('es');
        $request->setApiVersion('prog');
        $request->setChannel(321);
        $request->setReturnUrl('http://example.com/return');
        $request->setNotifyUrl('http://example.com/notify');
        $request->setDescription('description for payment');
        $request->setCurrency('JPY');

        $requestData = $request->getData();

        $this->assertEquals($requestData['id'], 123456);
        $this->assertEquals($requestData['amount'], 10.00);
        $this->assertEquals($requestData['currency'], 'JPY');
        $this->assertEquals($requestData['description'], 'description for payment');
        $this->assertEquals($requestData['lang'], 'es');
        $this->assertEquals($requestData['type'], 100);
        $this->assertEquals($requestData['URL'], 'http://example.com/return');
        $this->assertEquals($requestData['URLC'], 'http://example.com/notify');
        $this->assertEquals($requestData['channel'], 321);
        $this->assertEquals($requestData['chk'], 'c0f78147d4c64739fd3ad5e723b8434a10d90a9f4fc64b4cd3a5ba1df1f2e60c');
    }

    public function testGetAction()
    {
        $request = new Request($this->getHttpClient(), $this->getHttpRequest());

        $request->setAction('http://example.com/');

        $this->assertEquals($request->getAction(), 'http://example.com/');
    }
}
