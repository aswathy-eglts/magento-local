<?php
namespace Egits\Override\Plugin;

use Magento\Customer\Model\Session;


class CustomerDataContext
{
    protected $_customerSession;
    protected $session;

    public function __construct(
    	Session $customerSession,
        
    	
    ) {
        $this->session = $customerSession;
    	    	
    }

    public function aroundExecute(
    	\Magento\Customer\Controller\Account\LoginPost $loginPost,
    	\Closure $proceed,
    	
    ) 
    {
    
           $returnValue = $proceed();
            $login = $loginPost->getRequest()->getPost('login');
            if (!empty($login['username']) && !empty($login['password'])) 
            {
                if($this->session->isLoggedIn()) 
                {
                    // Customer is logged in
                    $customer = $login['username'];
                    die($customer);
                }             
            
            
                            // if(!$customer){
                                //     return $proceed();
                                // }
                        
                            //   $this->_customerSession->getCustomerId();      	  
                            //   $this->_customerSession->getCustomer()->getEmail();
                            //   $this->customerSession->getCustomer()->getName();
                            //   return $returnValue ;
            }
        
    }
}