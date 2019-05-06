<?php

namespace Omnipay\Dotpay\Message;

use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Tests\TestCase;

class CompletePurchaseResponseTest extends TestCase
{
    const SIGNATURE_VALID = true;
    const SIGNATURE_INVALID = false;

    const OK_CODE = 200;
    const OK_MESSAGE = 'OK';
    const INVALID_CODE = 400;
    const INVALID_MESSAGE = 'FAIL';

    private $defaultParams = [
        'status' => 'OK',
        'pid' => '123456',
        'operation_number' => 'OPERATION-1',
    ];

    public function testConstruct()
    {
        $response = new CompletePurchaseResponse($this->getMockRequest(), $this->defaultParams, self::SIGNATURE_VALID);

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());

        $this->assertSame('OPERATION-1', $response->getTransactionReference());

        $this->assertSame(self::OK_MESSAGE, $response->getMessage());
        $this->assertSame(self::OK_CODE, $response->getCode());
    }

    public function testResponseWithValidSignature() {
        $response = new CompletePurchaseResponse($this->getMockRequest(),
            $this->defaultParams, self::SIGNATURE_VALID);

        $this->assertSame(self::OK_MESSAGE, $response->getMessage());
        $this->assertSame(self::OK_CODE, $response->getCode());
    }

    public function testResponseWithInvalidSignature() {
        $response = new CompletePurchaseResponse($this->getMockRequest(),
            $this->defaultParams, self::SIGNATURE_INVALID);

        $this->assertSame(self::INVALID_MESSAGE, $response->getMessage());
        $this->assertSame(self::INVALID_CODE, $response->getCode());
    }

    public function testResponseWithOperationStatusCompleted() {
        $data = $this->defaultParams + [
            'operation_status' => 'completed',
        ];
        $response = new CompletePurchaseResponse($this->getMockRequest(),
            $data, self::SIGNATURE_VALID);

        $this->assertSame(NotificationInterface::STATUS_COMPLETED, $response->getTransactionStatus());
        $this->assertSame(self::OK_MESSAGE, $response->getMessage());
        $this->assertSame(self::OK_CODE, $response->getCode());
    }

    public function testResponseWithOperationStatusRejected() {
        $data = $this->defaultParams + [
            'operation_status' => 'rejected',
        ];
        $response = new CompletePurchaseResponse($this->getMockRequest(),
            $data, self::SIGNATURE_VALID);

        $this->assertSame(NotificationInterface::STATUS_FAILED, $response->getTransactionStatus());
        $this->assertSame(self::OK_MESSAGE, $response->getMessage());
        $this->assertSame(self::OK_CODE, $response->getCode());
    }

    public function testResponseWithOperationStatusProcessingRealizationWaiting() {
        $data = $this->defaultParams + [
            'operation_status' => 'processing_realization_waiting',
        ];
        $response = new CompletePurchaseResponse($this->getMockRequest(),
            $data, self::SIGNATURE_VALID);

        $this->assertSame(NotificationInterface::STATUS_PENDING, $response->getTransactionStatus());
        $this->assertSame(self::OK_MESSAGE, $response->getMessage());
        $this->assertSame(self::OK_CODE, $response->getCode());
    }

    public function testResponseWithOperationStatusProcessingRealization() {
        $data = $this->defaultParams + [
            'operation_status' => 'processing_realization',
        ];
        $response = new CompletePurchaseResponse($this->getMockRequest(),
            $data, self::SIGNATURE_VALID);

        $this->assertSame(NotificationInterface::STATUS_PENDING, $response->getTransactionStatus());
        $this->assertSame(self::OK_MESSAGE, $response->getMessage());
        $this->assertSame(self::OK_CODE, $response->getCode());
    }

}
