<?php

namespace Prymag\IhabInquiryForm\Block;

use Magento\Framework\App\Request\DataPersistorInterface;


class InquiryForm extends \Magento\Framework\View\Element\Template
{
    protected $_dataPersistor;

    protected $_modal;

    /**
     * @var array
     */
     private $postData = null;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Modal $modal,
        DataPersistorInterface $dataPersistor,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->_modal = $modal;
        $this->_dataPersistor = $dataPersistor;
    }

    public function getFormAction()
    {
        # code...
        return $this->getUrl('inquiry/post', ['_secure' => true]);
    }

    /**
    * Get value from POST by key
    *
    * @param string $key
    * @return string
    */
    public function getPostValue($key)
    {
        //
        if (null === $this->postData) {
            $this->postData = (array) $this->_dataPersistor->get('inquiry_form');
            $this->_dataPersistor->clear('inquiry_form');
        }

        if (isset($this->postData[$key])) {
            return (string) $this->postData[$key];
        }
 
         return '';
    }

    public function makeModal($blockId, $title, $trigger)
    {
        # code...
        return $this->_modal
            ->setTitle($title)
            ->setContentBlockId($blockId)
            ->setTrigger($trigger)
            ->toHtml();
    }

    public function getModalBlockId($blockId)
    {
        # code...
        $blockId = $this->getData($blockId);
        return $blockId;
    }

}