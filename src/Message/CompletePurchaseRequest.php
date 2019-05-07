<?php

namespace Omnipay\Dotpay\Message;

use Omnipay\Dotpay\ChkGenerator;

/**
 * Dotpay Complete Purchase Request.
 */
class CompletePurchaseRequest extends Request
{
    /**
     * @inheritdoc
     * @return mixed
     */
    public function getData()
    {
        return $this->httpRequest->request->all();
    }

    /**
     * @inheritdoc
     *
     * @param mixed $data
     *
     * @return CompletePurchaseResponse
     */
    public function sendData($data)
    {
        $signatureValid = $this->validateSignature($data);
        return $this->response = new CompletePurchaseResponse($this, $data, $signatureValid);
    }

    /**
     * Validate signature from Dotpay response
     * and return transaction status.
     *
     * @param array $data
     *
     * @return bool
     */
    private function validateSignature($data)
    {
        return ChkGenerator::generateSignature($this->getPid(), $data) === $data['signature'];
    }
}
