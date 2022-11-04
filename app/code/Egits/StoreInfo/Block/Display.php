<?php
namespace Egits\StoreInfo\Block;
use Egits\StoreInfo\Helper\Display as NewDisplay;

class Display extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context,NewDisplay $helper)
    {

        $this->helper = $helper;
        parent::__construct($context);

    }
    public function newFunction()
    {
       return $this->helper;
    }
}
