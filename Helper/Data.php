<?php

namespace Prymag\PurchaseForm\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    const XML_PATH_DEFAULTS = 'Prymag_PurchaseForm/defaults/';

    const XML_PATH_ANALYTICS = 'Prymag_PurchaseForm/analytics/';

    public function getPOSTUrl($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'post_url',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getMerchantKey($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'merchant_key',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getCampaignCode($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'campaign_code',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getCampaignId($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'campaign_id',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getEntryId($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'entry_id',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getSellerCode($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'seller_code',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getCountryCode($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'country_code',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getTermsBlockId($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'terms_block',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getPolicyBlockId($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEFAULTS . 'policy_block',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getTrackingCode($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_ANALYTICS . 'tracking_code',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    public function getTrackingName($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_ANALYTICS . 'tracking_name',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }
    
    public function getSMSNumber($store = null)
    {
        # code...
        return $this->scopeConfig->getValue(
            self::XML_PATH_ANALYTICS . 'sms_number',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }

}