<?php

namespace Prymag\PurchaseForm\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\Action;

use Magento\Contact\Model\ConfigInterface;
use Prymag\PurchaseForm\Model\MailInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;

use Psr\Log\LoggerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\ResultFactory; 


class Index extends Action implements HttpPostActionInterface {

    /**
     * @var DataPersistorInterface
     */
     private $dataPersistor;
 
     /**
      * @var MailInterface
      */
     private $mail;
 
     /**
      * @var LoggerInterface
      */
     private $logger;

    public function __construct(
        Context $context,
        MailInterface $mail,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger = null
    ) {
        parent::__construct($context);
        $this->mail = $mail;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
    }

    public function redirectBack()
    {
        # code...
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    public function execute()
    {
        # code...
        try {
            $this->sendEmail($this->validatedParams());
            $this->messageManager->addSuccess(__("Success"));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('inquiry_form', $this->getRequest()->getParams());
            return $this->redirectBack();
        }
        return $this->redirectBack();
    }

    /**
     * @param array $post Post data from contact form
     * @return void
     */
     private function sendEmail($post)
     {
        $this->mail->send(
            $post['email'],
            ['data' => new DataObject($post)]
        );
     }

    /**
     * @return array
     * @throws \Exception
     */
     private function validatedParams()
     {
         $request = $this->getRequest();
         //die($request->getPostValue('phone'));

         /**
          * @Todo: Serverside validation
          */
         if (trim($request->getParam('phone')) === '') {
             throw new LocalizedException(__('Enter phone and try again.'));
         }
 
         return $request->getParams();
     }

}