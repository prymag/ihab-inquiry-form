<?php

namespace Prymag\PurchaseForm\Block;

use Magento\Framework\App\Request\DataPersistorInterface;
use Prymag\PurchaseForm\Model\MailInterface;

class PurchaseForm extends \Magento\Framework\View\Element\Template
{
    protected $_dataPersistor;

    protected $_objectManager;

    /**
     * @var array
     */
     private $postData = null;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        DataPersistorInterface $dataPersistor,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->_objectManager = $objectManager;
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
            $this->postData = (array) $this->_dataPersistor->get('purchase_form');
            $this->_dataPersistor->clear('purchase_form');
        }

        if (isset($this->postData[$key])) {
            return (string) $this->postData[$key];
        }
 
         return '';
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

    public function getModalBlockId($blockId)
    {
        # code...
        $blockId = $this->getData($blockId);
        return $blockId;
    }

}