<?php 
namespace Prymag\IhabInquiryForm\Block\Widget;

use Prymag\IhabInquiryForm\Block\InquiryForm as ParentBlock;
use Magento\Widget\Block\BlockInterface; 
 
class InquiryForm extends ParentBlock implements BlockInterface {

    protected $_template = "inquiry-form.phtml";

}