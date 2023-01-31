<?php
namespace Egits\ImageUpload\Model;
use Egits\ImageUpload\Model\ResourceModel\Promo\CollectionFactory;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
   /**
   * @param string $name
   * @param string $primaryFieldName
   * @param string $requestFieldName
   * @param CollectionFactory $promoCollectionFactory
   * @param array $meta
   * @param array $data
   */
   public function __construct(
   $name,
   $primaryFieldName,
   $requestFieldName,
   CollectionFactory $promoCollectionFactory,
   array $meta = [],
   array $data = []
   ) {
       $this->collection = $promoCollectionFactory->create();
       parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
      }
       /**
       * Get data
       *
       * @return array
       */
       public function getData()
       {
       return [];
       }
}