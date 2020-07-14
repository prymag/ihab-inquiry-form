<?php
namespace Prymag\PurchaseForm\Controller\Ajax;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Request\DataPersistorInterface;


class Analytics extends \Magento\Framework\App\Action\Action
{    
    //
    protected $_jsonFactory;

    protected $_dataPersistor;
    
	public function __construct(
        DataPersistorInterface $dataPersistor,
		Context $context,
        JsonFactory $jsonFactory
    )
	{
        $this->_dataPersistor = $dataPersistor;
		$this->_jsonFactory = $jsonFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
        $resultJson = $this->_jsonFactory->create();
        $response = $this->_dataPersistor->get('purchase_form_analytics');
        return $resultJson->setData($response);
	}
}