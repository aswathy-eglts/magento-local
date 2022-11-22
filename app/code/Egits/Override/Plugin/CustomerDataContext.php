<?php
namespace Egits\Override\Plugin;

use Egits\Override\Model\ResourceModel\Post;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Result\PageFactory;
use Egits\Override\Model\ResourceModel\Post\CollectionFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;

class CustomerDataContext  
{
    protected $customerSession;
    protected $CollectionFactory;
    protected $pageFactory;
    protected $post;
    protected $date;
    public function __construct( 
        CollectionFactory $CollectionFactory,
    	Session $customerSession,
        PageFactory $pageFactory,
        Post $post,
    	DateTime $date,
    ) {
        $this->_pageFactory = $pageFactory;
        $this->session = $customerSession;
        $this->CollectionFactory = $CollectionFactory; 
        $this->post = $post; 
        $this->date = $date; 
    	    	
    }

    public function aroundExecute(
    	\Magento\Customer\Controller\Account\LoginPost $loginPost, $proceed ) 
    {
            $returnValue = $proceed();
            $login = $loginPost->getRequest()->getPost('login');
            $customer = $login['username'];
            if($this->session->isLoggedIn()) 
                {
                  
                    $collection = $this->CollectionFactory->create();
                    $collection->addFieldToFilter('Email', ['eq' => $customer]);
                    $FilteredData = $collection->getFirstItem();
                    $emailget = $FilteredData->getEmail();
                    if (!empty($emailget) && $emailget == $customer)
                    {

                    $count= $FilteredData->getLogin_attempt()+1;
                    $date = $this->date->gmtDate();
                    $FilteredData ->setLogin_attempt($count);
                    $FilteredData ->setEmail($customer);
                    $FilteredData ->setUpdate_time($date); 
                    $this->post->save($FilteredData); 
                  
                    }
                    else
                    {
                        $count= $FilteredData->getLogin_attempt();
                        $FilteredData ->setEmail($customer);
                        $FilteredData ->setLogin_attempt(0);
                        $this->post->save($FilteredData); 
 
                    }
                  
               } 
                // else
                // { 

                //     $collection = $this->CollectionFactory->create(); 
                //     $FilteredData = $collection->getFirstItem(); 
                //     $FilteredData ->setEmail($customer);
                //     $FilteredData ->setLogin_attempt(0); 
                //     $this->post->save($FilteredData);     
                // }
        return $returnValue;
    }
}