<?php

namespace Prymag\PurchaseForm\Block;

class SmsButton extends Base
{
    protected $_title = '';

    protected $_template = 'Prymag_PurchaseForm::purchase-form/sms-button.phtml';

    public function getSMSNumber()
    {
        # code...
        $smsNumber = $this->getData('sms_number');

        if (!$smsNumber || $smsNumber == '') {
            $smsNumber = $this->_helper->getSMSNumber();
        }

        return $smsNumber;
    }

}