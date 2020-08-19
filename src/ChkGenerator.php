<?php


namespace Omnipay\Dotpay;

class ChkGenerator
{
    public static function generateChk($accountId, $pid, $params)
    {
        $params['id'] = $accountId;
        $chain =
            $pid.
            (isset($params['api_version']) ? $params['api_version'] : null).
            (isset($params['lang']) ? $params['lang'] : null).
            (isset($params['id']) ? $params['id'] : null).
            (isset($params['pid']) ? $params['pid'] : null).
            (isset($params['amount']) ? $params['amount'] : null).
            (isset($params['currency']) ? $params['currency'] : null).
            (isset($params['description']) ? $params['description'] : null).
            (isset($params['control']) ? $params['control'] : null).
            (isset($params['channel']) ? $params['channel'] : null).
            (isset($params['credit_card_brand']) ? $params['credit_card_brand'] : null).
            (isset($params['ch_lock']) ? $params['ch_lock'] : null).
            (isset($params['channel_groups']) ? $params['channel_groups'] : null).
            (isset($params['onlinetransfer']) ? $params['onlinetransfer'] : null).
            (isset($params['url']) ? $params['url'] : null).
            (isset($params['type']) ? $params['type'] : null).
            (isset($params['buttontext']) ? $params['buttontext'] : null).
            (isset($params['urlc']) ? $params['urlc'] : null).
            (isset($params['firstname']) ? $params['firstname'] : null).
            (isset($params['lastname']) ? $params['lastname'] : null).
            (isset($params['email']) ? $params['email'] : null).
            (isset($params['street']) ? $params['street'] : null).
            (isset($params['street_n1']) ? $params['street_n1'] : null).
            (isset($params['street_n2']) ? $params['street_n2'] : null).
            (isset($params['state']) ? $params['state'] : null).
            (isset($params['addr3']) ? $params['addr3'] : null).
            (isset($params['city']) ? $params['city'] : null).
            (isset($params['postcode']) ? $params['postcode'] : null).
            (isset($params['phone']) ? $params['phone'] : null).
            (isset($params['country']) ? $params['country'] : null).
            (isset($params['code']) ? $params['code'] : null).
            (isset($params['p_info']) ? $params['p_info'] : null).
            (isset($params['p_email']) ? $params['p_email'] : null).
            (isset($params['n_email']) ? $params['n_email'] : null).
            (isset($params['expiration_date']) ? $params['expiration_date'] : null).
            (isset($params['deladdr']) ? $params['deladdr'] : null).
            (isset($params['recipient_account_number']) ? $params['recipient_account_number'] : null).
            (isset($params['recipient_company']) ? $params['recipient_company'] : null).
            (isset($params['recipient_first_name']) ? $params['recipient_first_name'] : null).
            (isset($params['recipient_last_name']) ? $params['recipient_last_name'] : null).
            (isset($params['recipient_address_street']) ? $params['recipient_address_street'] : null).
            (isset($params['recipient_address_building']) ? $params['recipient_address_building'] : null).
            (isset($params['recipient_address_apartment']) ? $params['recipient_address_apartment'] : null).
            (isset($params['recipient_address_postcode']) ? $params['recipient_address_postcode'] : null).
            (isset($params['recipient_address_city']) ? $params['recipient_address_city'] : null).
            (isset($params['application']) ? $params['application'] : null).
            (isset($params['application_version']) ? $params['application_version'] : null).
            (isset($params['warranty']) ? $params['warranty'] : null).
            (isset($params['bylaw']) ? $params['bylaw'] : null).
            (isset($params['personal_data']) ? $params['personal_data'] : null).
            (isset($params['credit_card_number']) ? $params['credit_card_number'] : null).
            (isset($params['credit_card_expiration_date_year']) ? $params['credit_card_expiration_date_year'] : null).
            (isset($params['credit_card_expiration_date_month']) ? $params['credit_card_expiration_date_month'] : null).
            (isset($params['credit_card_security_code']) ? $params['credit_card_security_code'] : null).
            (isset($params['credit_card_store']) ? $params['credit_card_store'] : null).
            (isset($params['credit_card_store_security_code']) ? $params['credit_card_store_security_code'] : null).
            (isset($params['credit_card_customer_id']) ? $params['credit_card_customer_id'] : null).
            (isset($params['credit_card_id']) ? $params['credit_card_id'] : null).
            (isset($params['blik_code']) ? $params['blik_code'] : null).
            (isset($params['credit_card_registration']) ? $params['credit_card_registration'] : null).
            (isset($params['surcharge_amount']) ? $params['surcharge_amount'] : null).
            (isset($params['surcharge']) ? $params['surcharge'] : null).
            (isset($params['surcharge']) ? $params['surcharge'] : null).
            (isset($params['ignore_last_payment_channel']) ? $params['ignore_last_payment_channel'] : null).
            (isset($params['vco_call_id']) ? $params['vco_call_id'] : null).
            (isset($params['vco_update_order_info']) ? $params['vco_update_order_info'] : null).
            (isset($params['vco_subtotal']) ? $params['vco_subtotal'] : null).
            (isset($params['vco_shipping_handling']) ? $params['vco_shipping_handling'] : null).
            (isset($params['vco_tax']) ? $params['vco_tax'] : null).
            (isset($params['vco_discount']) ? $params['vco_discount'] : null).
            (isset($params['vco_gift_wrap']) ? $params['vco_gift_wrap'] : null).
            (isset($params['vco_misc']) ? $params['vco_misc'] : null).
            (isset($params['vco_promo_code']) ? $params['vco_promo_code'] : null).
            (isset($params['credit_card_security_code_required']) ? $params['credit_card_security_code_required'] : null).
            (isset($params['credit_card_operation_type']) ? $params['credit_card_operation_type'] : null).
            (isset($params['credit_card_avs']) ? $params['credit_card_avs'] : null).
            (isset($params['credit_card_threeds']) ? $params['credit_card_threeds'] : null).
            (isset($params['customer']) ? $params['customer'] : null).
            (isset($params['gp_token']) ? $params['gp_token'] : null).
            (isset($params['blik_refusenopayid']) ? $params['blik_refusenopayid'] : null).
            (isset($params['auto_reject_date']) ? $params['auto_reject_date'] : null).    
            (isset($params['ap_token']) ? $params['ap_token'] : null);

        return hash('sha256', $chain);
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
