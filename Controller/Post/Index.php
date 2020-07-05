<?php

namespace Prymag\IhabInquiryForm\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\Action;

use Magento\Contact\Model\ConfigInterface;
use Magento\Contact\Model\MailInterface;
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
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    public function execute()
    {
        # code...
        try {
            $this->sendEmail($this->validatedParams());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('inquiry_form', $this->getRequest()->getParams());
            return $this->redirectBack();
            die($e->getMessage());
            /* $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('contact_us', $this->getRequest()->getParams()); */
        }
        die('We are here...');
        return 'Hello world!!';
    }

    /**
     * @param array $post Post data from contact form
     * @return void
     */
     private function sendEmail($post)
     {

         /* $this->mail->send(
             $post['email'],
             ['data' => new DataObject($post)]
         ); */
     }

    /**
     * @return array
     * @throws \Exception
     */
     private function validatedParams()
     {
         $request = $this->getRequest();
         //die($request->getPostValue('phone'));

         if (trim($request->getParam('phone')) === '') {
             throw new LocalizedException(__('Enter phone and try again.'));
         }
         if (trim($request->getParam('comment')) === '') {
             throw new LocalizedException(__('Enter the comment and try again.'));
         }
         if (false === \strpos($request->getParam('email'), '@')) {
             throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
         }
         if (trim($request->getParam('hideit')) !== '') {
             throw new \Exception();
         }
 
         return $request->getParams();
     }

}