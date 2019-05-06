<?php

namespace Omnipay\Dotpay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Dotpay Complete Purchase Response.
 */
class CompletePurchaseResponse extends AbstractResponse implements NotificationInterface
{
    /**
     * @var bool
     */
    private $signatureValid;

    /**
     * Ok transaction status.
     */
    const STATUS_OK = 'OK';

    /**
     * Fail transaction status.
     */
    const STATUS_FAIL = 'FAIL';

    const OPERATION_STATUS_COMPLETED = 'completed';
    const OPERATION_STATUS_NEW = 'new';
    const OPERATION_STATUS_REJECTED = 'rejected';
    const OPERATION_STATUS_PROCESSING_REALIZATION_WAITING = 'processing_realization_waiting';
    const OPERATION_STATUS_PROCESSING_REALIZATION = 'processing_realization';

    /**
     * @inheritdoc
     */
    public function __construct(RequestInterface $request, $data, $signatureValid)
    {
        parent::__construct($request, $data);
        $this->signatureValid = $signatureValid;
    }

    /**
     * @inheritdoc
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->signatureValid;
    }

    /**
     * @return string|null
     */
    public function getTransactionReference()
    {
        return isset($this->data['operation_number']) ? $this->data['operation_number'] : '';
    }

    /**
     * @inheritdoc
     */
    public function getMessage()
    {
        return $this->isSuccessful() ? self::STATUS_OK : self::STATUS_FAIL;
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        return $this->isSuccessful() ? 200 : 400;
    }

    /**
     * @inheritdoc
     */
    public function getTransactionStatus()
    {
        switch ($this->data['operation_status']) {
            case self::OPERATION_STATUS_COMPLETED:
                return NotificationInterface::STATUS_COMPLETED;

            case self::OPERATION_STATUS_REJECTED:
                return NotificationInterface::STATUS_FAILED;

            case self::OPERATION_STATUS_NEW:
            case self::OPERATION_STATUS_PROCESSING_REALIZATION:
            case self::OPERATION_STATUS_PROCESSING_REALIZATION_WAITING:
                return NotificationInterface::STATUS_PENDING;
        }
    }
}
