<?php

namespace Prymag\PurchaseForm\Block;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\ObjectManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Prymag\PurchaseForm\Helper\Data as Helper;

class Base extends \Magento\Framework\View\Element\Template
{
    protected $_dataPersistor;

    protected $_objectManager;

    protected $_helper;

    protected $_storeManager;

    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        Helper $helper,
        ObjectManagerInterface $objectManager,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->_storeManager = $storeManager;
        $this->_helper = $helper;
        $this->_objectManager = $objectManager;
        $this->_dataPersistor = $dataPersistor;
    }

    public function makeModal($blockId, $trigger)
    {
        # code...
        $modal = $this->_objectManager->create(Modal::class);

        return $modal
            ->setContentBlockId($blockId)
            ->setTrigger($trigger)
            ->toHtml();
    }
    
    public function getMerchant()
    {
        # code...
        return $this->_helper->getMerchantKey();
    }

    public function getPage()
    {
        # code...
        return $this->getData('page_code');
    }

    public function getCampaignCode()
    {
        # code...
        if ($this->getData('campaign_code') != '') {
            return $this->getData('campaign_code');
        }

        return $this->_helper->getCampaignCode();
    }

    public function getSeller()
    {
        # code...
        if ($this->getData('seller_code') != '') {
            return $this->getData('seller_code');
        }

        return $this->_helper->getSellerCode();
    }

    public function getCountry()
    {
        # code...
        if ($this->getData('country_code') != '') {
            return $this->getData('country_code');
        }

        return $this->_helper->getCountryCode();
    }

    public function getPolicyBlockId()
    {
        # code...
        $blockId = $this->getData('policyBlockId');

        if(!$blockId || $blockId == '') {
            return $this->_helper->getPolicyBlockId();
        }

        return $blockId;
    }

    public function getTermsBlockId()
    {
        # code...
        $blockId = $this->getData('termsBlockId');

        if(!$blockId || $blockId == '') {
            return $this->_helper->getPolicyBlockId();
        }

        return $blockId;
    }
}