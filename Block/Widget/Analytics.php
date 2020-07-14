<?php

namespace Prymag\PurchaseForm\Block\Widget;

use Prymag\PurchaseForm\Block\Base;
use Magento\Widget\Block\BlockInterface; 


class Analytics extends Base implements BlockInterface 
{
    protected $_title = '';

    protected $_template = 'analytics.phtml';

    public function getAjaxUrl()
    {
        # code...
        return $this->getUrl("prymag/ajax/analytics");
    }

    public function getTrackingCode()
    {
        # code...
        return $this->_helper->getTrackingCode();
    }

    public function getTrackingName()
    {
        # code...
        return $this->_helper->getTrackingName();
    }

    public function getCategoryVariation()
    {
        # code...
        $seller = $this->getSeller();
        $campaignCode = $this->getCampaignCode();
        $campaignId = $this->getCampaignId();
        $entryId = $this->getEntryId();

        return "CampCode: {$campaignCode} CampId: {$campaignId} EntryId: {$entryId} SellerId: {$seller}";
    }

}