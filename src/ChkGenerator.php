<?php


namespace Omnipay\Dotpay;

class ChkGenerator
{
    public static function generateChk($pid, $params)
    {
        ksort($params);

        $paramList = implode(';', array_keys($params));

        //adding the parameter 'paramList' with sorted list of parameters to the array
        $params['paramsList'] = $paramList;

        //re-sorting the parameter list
        ksort($params);

        //json encoding with JSON_UNESCAPED_SLASHES
        $json = json_encode($params, JSON_UNESCAPED_SLASHES);

        // generate hash
        return hash_hmac('sha256', $json, $pid, false);
    }

    public static function generateSignature($pid, $params)
    {
        $chain = $pid.
        (isset($params['id']) ? $params['id'] : '') . 
        (isset($params['operation_number']) ? $params['operation_number'] : '') . 
        (isset($params['operation_type']) ? $params['operation_type'] : '') . 
        (isset($params['operation_status']) ? $params['operation_status'] : '') . 
        (isset($params['operation_amount']) ? $params['operation_amount'] : '') . 
        (isset($params['operation_currency']) ? $params['operation_currency'] : '') . 
        (isset($params['operation_withdrawal_amount']) ? $params['operation_withdrawal_amount'] : '') . 
        (isset($params['operation_commission_amount']) ? $params['operation_commission_amount'] : '') . 
        (isset($params['is_completed']) ? $params['is_completed'] : '') . 
        (isset($params['operation_original_amount']) ? $params['operation_original_amount'] : '') . 
        (isset($params['operation_original_currency']) ? $params['operation_original_currency'] : '') . 
        (isset($params['operation_datetime']) ? $params['operation_datetime'] : '') . 
        (isset($params['operation_related_number']) ? $params['operation_related_number'] : '') . 
        (isset($params['control']) ? $params['control'] : '') . 
        (isset($params['description']) ? $params['description'] : '') . 
        (isset($params['email']) ? $params['email'] : '') . 
        (isset($params['p_info']) ? $params['p_info'] : '') . 
        (isset($params['p_email']) ? $params['p_email'] : '') . 
        (isset($params['credit_card_issuer_identification_number']) ? $params['credit_card_issuer_identification_number'] : '') . 
        (isset($params['credit_card_masked_number']) ? $params['credit_card_masked_number'] : '') . 
        (isset($params['credit_card_expiration_year']) ? $params['credit_card_expiration_year'] : '') . 
        (isset($params['credit_card_expiration_month']) ? $params['credit_card_expiration_month'] : '') . 
        (isset($params['credit_card_brand_codename']) ? $params['credit_card_brand_codename'] : '') . 
        (isset($params['credit_card_brand_code']) ? $params['credit_card_brand_code'] : '') . 
        (isset($params['credit_card_unique_identifier']) ? $params['credit_card_unique_identifier'] : '') . 
        (isset($params['credit_card_id']) ? $params['credit_card_id'] : '') . 
        (isset($params['channel']) ? $params['channel'] : '') . 
        (isset($params['channel_country']) ? $params['channel_country'] : '') . 
        (isset($params['geoip_country']) ? $params['geoip_country'] : '') . 
        (isset($params['payer_bank_account_name']) ? $params['payer_bank_account_name'] : '') . 
        (isset($params['payer_bank_account']) ? $params['payer_bank_account'] : '') . 
        (isset($params['payer_transfer_title']) ? $params['payer_transfer_title'] : '') . 
        (isset($params['blik_voucher_pin']) ? $params['blik_voucher_pin'] : '') . 
        (isset($params['blik_voucher_amount']) ? $params['blik_voucher_amount'] : '') . 
        (isset($params['blik_voucher_amount_used']) ? $params['blik_voucher_amount_used'] : '') . 
        (isset($params['channel_reference_id']) ? $params['channel_reference_id'] : '');

        return hash('sha256', $chain);
    }
}
