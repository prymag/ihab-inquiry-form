<?php 
namespace Prymag\PurchaseForm\Block\Widget;

use Prymag\PurchaseForm\Block\PurchaseForm as ParentBlock;
use Magento\Widget\Block\BlockInterface; 
 
class PurchaseForm extends ParentBlock implements BlockInterface {

    protected $_template = "purchase-form.phtml";

}