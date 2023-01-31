<?php

namespace Egits\EmployeeForm\Model;

use Egits\EmployeeForm\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider

{
   
 protected $dataPersistor;
 protected $loadedData;

 public function __construct(

 $name,

$primaryFieldName,

$requestFieldName,

 CollectionFactory $CollectionFactory,
 DataPersistorInterface $dataPersistor,

 array $meta = [],

 array $data = []

 ) {

 $this->collection = $CollectionFactory->create();
 $this->dataPersistor = $dataPersistor;
 parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

 }

 public function getData()

 {

//     if (isset($this->loadedData)) {

//  $this->loadedData;

// }

$items = $this->collection->getItems();

foreach ($items as $item) {

$this->loadedData[$item->getId()] = $item->getData();

}
$data = $this->dataPersistor->get('uiexample');
if (!empty($data)) {
   $model = $this->collection->getNewEmptyItem();
   $model->setData($data);
   $this->loadedData[$model->getId()] = $model->getData();
   $this->dataPersistor->clear('uiexample');
}
return $this->loadedData;

}

}