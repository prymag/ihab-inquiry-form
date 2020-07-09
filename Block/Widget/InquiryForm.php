<?php 
namespace Prymag\PurchaseForm\Block\Widget;

use Prymag\PurchaseForm\Block\InquiryForm as ParentBlock;
use Magento\Widget\Block\BlockInterface; 
 
class InquiryForm extends ParentBlock implements BlockInterface {

    protected $_template = "inquiry-form.phtml";

}