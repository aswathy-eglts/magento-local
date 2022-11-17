<?php

namespace Egits\Override\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class CustomerHelper extends AbstractHelper
{
    protected $_httpContext;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Http\Context $httpContext
    ) {
        $this->_httpContext = $httpContext;
        parent::__construct($context);
    }

    public function getIsCustomerLoggedIn()
    {
    	return (bool)$this->_httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
    }

    public function getCustomerId()
    {
    	return $this->_httpContext->getValue('customer_id');
    }

    public function getCustomerEmail()
    {	
        return $this->_httpContext->getValue('customer_email');
    }
}