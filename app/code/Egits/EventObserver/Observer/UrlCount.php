<?php
declare(strict_types=1);

namespace Egits\EventObserver\Observer;

use Egits\EventObserver\Model\ResourceModel\Post;
use Egits\EventObserver\Model\ResourceModel\Post\CollectionFactory; 
// use Magento\Framework\View\Result\PageFactory;

class UrlCount implements \Magento\Framework\Event\ObserverInterface
{
    protected $urlInterface;
    protected $post;
    protected $CollectionFactory;
    // protected $PageFactory;

    public function __construct(
   
       \Magento\Framework\UrlInterface $urlInterface,
       Post $post,
       CollectionFactory $CollectionFactory,
    //    PageFactory $PageFactory
        
    ) {    
        $this->urlInterface = $urlInterface;
        $this->post = $post;
        $this->CollectionFactory = $CollectionFactory;
        // $this->PageFactory = $PageFactory;
        
    }
   public function execute(\Magento\Framework\Event\Observer $observer)
    {
        
        $currentUrl = $this->urlInterface->getCurrentUrl();

        $collection = $this->CollectionFactory->create();
        $collection->addFieldToFilter('url', ['eq' => $currentUrl]);
        $FilteredData = $collection->getFirstItem();
        $geturl = $FilteredData->getUrl();
        if (!empty($geturl) && $geturl == $currentUrl)
        {
           
            $count= $FilteredData->getCount()+1;
            $FilteredData ->setCount($count);
            $FilteredData ->setUrl($currentUrl);
            $this->post->save($FilteredData);
        }
       
       else
       {
        $FilteredData->setUrl($currentUrl);
        $FilteredData ->setCount(1);
        $this->post->save($FilteredData); 
       }

    }
}