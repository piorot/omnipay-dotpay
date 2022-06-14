<?php

namespace Omnipay\Dotpay;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setAccountId(123456);
        $this->gateway->setPid('secretPidtoken');
        $this->gateway->setType(0);
        $this->gateway->setAction('https://ssl.dotpay.pl/test_payment/');
        $this->gateway->setLang('pl');
        $this->gateway->setApiVersion('next');
        $this->gateway->setChannel(123);

        $this->options = array(
            'amount' => '123.00',
            'returnUrl' => 'https://www.example.com/return',
        );
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getMessage());
        $this->assertContains('https://ssl.dotpay.pl/test_payment/', $response->getRedirectUrl());
        $this->assertSame('POST', $response->getRedirectMethod());
        $this->assertNotNull($response->getRedirectData());
    }

    public function testCompletePurchaseSuccess()
    {
        $data = array(
            'status' => 'OK',
            'operation_number' => 'OPERATION-1',
        );

        $this->getHttpRequest()->request->replace(
            $data + array(
                'signature' => ChkGenerator::generateSignature($this->gateway->getPid(), $data),
            )
        );

        $response = $this->gateway->completePurchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('OPERATION-1', $response->getTransactionReference());
        $this->assertSame('OK', $response->getMessage());
        $this->assertSame(200, $response->getCode());
    }
}
