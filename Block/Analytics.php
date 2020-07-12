<?php

namespace Prymag\PurchaseForm\Block;

class Analytics extends Base
{
    protected $_title = '';

    protected $_template = 'Prymag_PurchaseForm::purchase-form/analytics.phtml';

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