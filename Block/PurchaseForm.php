<?php

namespace Prymag\PurchaseForm\Block;

class PurchaseForm extends Base
{
    public function getForm()
    {
        # code...
        return $this->_objectManager
            ->create(Form::class)
            ->setData($this->getData())
            ->toHtml();
    }

}