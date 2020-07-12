<?php

namespace Prymag\PurchaseForm\Block;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\ObjectManagerInterface;
use Prymag\PurchaseForm\Helper\Data as Helper;

class Base extends \Magento\Framework\View\Element\Template
{
    protected $_dataPersistor;

    protected $_objectManager;

    protected $_helper;

    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        Helper $helper,
        ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->_helper = $helper;
        $this->_objectManager = $objectManager;
        $this->_dataPersistor = $dataPersistor;
    }

    /**
     * Get Store
     * 
     * @return Magento\Store\Model\StoreManager
     */
    public function getStore()
    {
        # code...
        /** @var Magento\Store\Model\StoreManager $store */
        return $this->_storeManager->getStore();
    }

    public function getStoreURL()
    {
        //
        return $this->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_LINK);
    }

    /**
     * @var boolean $asCss - Get result as css background-image
     */
    public function getBackgroundImage($asCss = false) {
        //
        $backgroundImage = '';
        if ($this->getData('background_image')) {
            $type = \Magento\Framework\UrlInterface::URL_TYPE_MEDIA;
            $mediaUrl = $this->getStore()
                ->getBaseUrl($type);

            $backgroundImage = $mediaUrl . $this->getData('background_image');

            if ($asCss) {
                $backgroundImage = "background-image:url('{$backgroundImage}')";
            }
        }

        return $backgroundImage;
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

    public function getCampaignId()
    {
        # code...
        return $this->_helper->getCampaignId();
    }

    public function getEntryId()
    {
        # code...
        return $this->_helper->getEntryId();
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
        $blockId = $this->getData('policy_block_id');

        if(!$blockId || $blockId == '') {
            return $this->_helper->getPolicyBlockId();
        }

        return $blockId;
    }

    public function getTermsBlockId()
    {
        # code...
        $blockId = $this->getData('terms_block_id');

        if(!$blockId || $blockId == '') {
            return $this->_helper->getPolicyBlockId();
        }

        return $blockId;
    }
}