<?php

namespace Prymag\PurchaseForm\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;

class Modal extends Template
{

    protected $_title = '';

    protected $_template = 'Prymag_PurchaseForm::purchase-form/modal.phtml';

    protected $_contentBlockId = 'terms';

    protected $_trigger = '[data-attribute="toggle-modal"]';

    protected $_block;

    protected $_blockRepository;
    
    protected $_storeManager;

    public function __construct(
        \Magento\Cms\Model\BlockRepository $blockRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        Context $context, 
        array $data = []
    )
    {
        $this->_storeManager = $storeManager;
        $this->_blockRepository = $blockRepository;
        parent::__construct($context, $data);
    }

    private function getCMSBlock()
    {
        # code...
        if (!$this->_block) {
            try {
                $this->_block = $this->_blockRepository->getById($this->_contentBlockId); 
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                
            }
        }

        return $this->_block;
    }

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

    public function getTitle()
    {
        # code...
        if (!$this->getCMSBlock()) {
            return '';
        }

        return $this->getCMSBlock()->getTitle();
    }

    public function getContent()
    {
        # code...
        if (!$this->getCMSBlock()) {
            return '';
        }

        return $this->getCMSBlock()->getContent();
    }

}