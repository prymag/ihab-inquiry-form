<?php

namespace Prymag\IhabInquiryForm\Block;

class Modal extends \Magento\Framework\View\Element\Template
{

    protected $_title = '';

    protected $_template = 'Prymag_IhabInquiryForm::inquiry-form/modal.phtml';

    protected $_contentBlockId = 'terms';

    protected $_trigger = '[data-attribute="toggle-modal"]';

    public function setContentBlockId($blockId)
    {
        # code...
        $this->_contentBlockId = $blockId;

        return $this;
    }

    public function setTrigger($trigger)
    {
        # code...
        if (!$trigger || $trigger == '') {
            return $this;
        }

        $this->_trigger = $trigger;

        return $this;
    }

    public function getTrigger()
    {
        # code...
        return $this->_trigger;
    }

    public function setTitle($title)
    {
        # code...
        $this->_title = $title;

        return $this;
    }

    public function getTitle()
    {
        # code...
        return $this->_title;
    }

    public function getContent()
    {
        # code...
        return $this->getLayout()
            ->createBlock('Magento\Cms\Block\Block')
            ->setBlockId($this->_contentBlockId)
            ->toHtml();
    }

}