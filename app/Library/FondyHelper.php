<?php

namespace App\Library;

class FondyHelper {
    
    public static function generateUrl($data)
    {
        \Cloudipsp\Configuration::setMerchantId(env('FONDY_MERCHANT_ID'));
        \Cloudipsp\Configuration::setSecretKey(env('FONDY_PASSWORD'));

        $result = \Cloudipsp\Checkout::url($data);
    
        return $result->getUrl();
    }

    public static function checkRequestData($requestParams)
    {
        $params = [];
        $requestSign = $requestParams['signature'];
        foreach ($requestParams as $key => $value) {
            $params[$key] = $value;
        }

        if(array_key_exists('response_signature_string', $params)) {
            unset( $params['response_signature_string'] );
        }
        unset( $params['signature'] );

        $params = array_filter($params,'strlen');
        ksort($params);
        $params = array_values($params);
        array_unshift( $params , env('FONDY_PASSWORD'));
        $params = join('|',$params);
        $resultSign = (sha1($params));

        return $resultSign == $requestSign;
    }
}