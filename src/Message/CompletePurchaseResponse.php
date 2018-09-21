<?php

namespace Omnipay\Dotpay\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Dotpay Complete Purchase Response.
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * Ok transaction status.
     */
    const STATUS_OK = 'OK';

    /**
     * Fail transaction status.
     */
    const STATUS_FAIL = 'FAIL';

    /**
     * Completed transaction status from Dotpay response.
     */
    const OPERATION_STATUS_COMPLETED = 'completed';

    /**
     * Validate signature from Dotpay response
     * and return transaction status.
     *
     * @param array $data
     *
     * @return OK | FAIL string
     */
    public function validateSignature($data)
    {
        $string = $data['pid'].
            (isset($data['id']) ? $data['id'] : '').
            (isset($data['operation_number']) ? $data['operation_number'] : '').
            (isset($data['operation_type']) ? $data['operation_type'] : '').
            (isset($data['operation_status']) ? $data['operation_status'] : '').
            (isset($data['operation_amount']) ? $data['operation_amount'] : '').
            (isset($data['operation_currency']) ? $data['operation_currency'] : '').
            (isset($data['operation_withdrawal_amount']) ? $data['operation_withdrawal_amount'] : '').
            (isset($data['operation_commission_amount']) ? $data['operation_commission_amount'] : '').
            (isset($data['operation_original_amount']) ? $data['operation_original_amount'] : '').
            (isset($data['operation_original_currency']) ? $data['operation_original_currency'] : '').
            (isset($data['operation_datetime']) ? $data['operation_datetime'] : '').
            (isset($data['operation_related_number']) ? $data['operation_related_number'] : '').
            (isset($data['control']) ? $data['control'] : '').
            (isset($data['description']) ? $data['description'] : '').
            (isset($data['email']) ? $data['email'] : '').
            (isset($data['p_info']) ? $data['p_info'] : '').
            (isset($data['p_email']) ? $data['p_email'] : '').
            (isset($data['channel']) ? $data['channel'] : '').
            (isset($data['channel_country']) ? $data['channel_country'] : '').
            (isset($data['geoip_country']) ? $data['geoip_country'] : '');

        if (hash('sha256', $string) === $data['signature'] &&
            $data['operation_status'] === self::OPERATION_STATUS_COMPLETED) {
            return self::STATUS_OK;
        } else {
            return self::STATUS_FAIL;
        }
    }

    /**
     * @inheritdoc
     * @return bool
     */
    public function isSuccessful()
    {
        if (!isset($this->data['status'])) {
            $this->data['status'] = $this->validateSignature($this->data);
        }

        return $this->data['status'] === self::STATUS_OK ? true : false;
    }
}
