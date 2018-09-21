<?php

namespace Omnipay\Dotpay\Message;

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
        $data['pid'] = $this->getPid();

        return $this->response = new CompletePurchaseResponse($this, $data);
    }
}
