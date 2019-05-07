<?php

namespace Omnipay\Dotpay\Message;

use Omnipay\Tests\TestCase;

class CompletePurchaseResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new CompletePurchaseresponse($this->getMockRequest(), array('status' => 'OK','pid' => '123456'));

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertEmpty($response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testValidateSignature() {
        $response = new CompletePurchaseresponse($this->getMockRequest(), array('status' => 'OK','pid' => '123456'));

        $data = array(
            'pid' => '123456',
            'id' => '123456',
            'email' => 'test@test',
            'operation_status' => 'completed'
        );

        $data['signature'] = hash('sha256', $data['pid'].$data['id'].$data['operation_status'].$data['email']);

        $this->assertSame('OK', $response->validateSignature($data));
    }

}
