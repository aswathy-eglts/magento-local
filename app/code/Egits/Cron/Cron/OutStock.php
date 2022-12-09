<?php

declare(strict_types=1);

namespace Egits\Cron\Cron;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
class OutStock
{
       
        protected $logger;

    public function __construct(
        \Egits\Cron\Logger\Logger $logger,
        CollectionFactory $productCollectionFactory
        )
    {
            $this->logger = $logger; 
            $this->productCollectionFactory = $productCollectionFactory;      
           
    }

     
      public function execute()
       {
       
         $productCollection = $this->productCollectionFactory
            ->create()
            ->addAttributeToSelect('*')
            ->addAttributeToSort('created_at', 'DESC')
            ->joinField('stock_item', 'cataloginventory_stock_item', 'qty', 'product_id=entity_id', 'qty=0')
            ->load();   
            foreach ($productCollection as $product) 
            {
                $data=$product->getName();
                $sku=$product->getSku();
                $id=$product->getId();
                $price=$product->getPrice();
                $this->logger->warning($data.'  '. $sku.'  '.$id.'  '.$price);
            }    
                  
        }
}

                