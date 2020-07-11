<?php

namespace Prymag\PurchaseForm\Block;

class Analytics extends Base
{
    protected $_title = '';

    protected $_template = 'Prymag_PurchaseForm::purchase-form/analytics.phtml';

    protected $_storeManager;

    protected $_helper;

    public function getStoreURL()
    {
        /** @TODO: Identify $store object */
        /** @var any $store */
        $store = $this->_storeManager->getStore();
        return $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_LINK);
    }

    public function getAnalyticsTracking()
    {
        # code...
        return $this->_helper->getAnalyticsTrackingCode();
    }

}