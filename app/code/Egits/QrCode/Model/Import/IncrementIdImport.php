<?php
namespace Egits\QrCode\Model\Import;

use Exception;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\ImportExport\Helper\Data as ImportHelper;
use Magento\ImportExport\Model\Import;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;
use Magento\ImportExport\Model\ResourceModel\Helper;
use Magento\ImportExport\Model\ResourceModel\Import\Data;
use Magento\ImportExport\Model\Import\Entity\AbstractEntity;
use Magento\Framework\Event\ObserverInterface;

// QRCODE
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Io\File;

class IncrementIdImport extends AbstractEntity implements ObserverInterface
{
     const ENTITY_CODE = 'Order_IncrementId';
     const TABLE = 'Order_IncrementId_OrderIncrementId';
     const ENTITY_ID_COLUMN = 'entity_id';
     const INCREMENTID= 'incrementid';


     /**
      * If we should check column names
      */
     protected $needColumnCheck = true;

     /**
      * Need to log in import history
      */
     protected $logInHistory = true;

     /**
      * Permanent entity columns.
       */
     protected $_permanentAttributes = [
         'entity_id'
     ];

     /**
      * Valid column names
      */
     protected $validColumnNames = [
         'entity_id',
         'incrementid'
     ];

     /**
      * @var AdapterInterface
      */
     protected $connection;

     /**
      * @var ResourceConnection
      */
     private $resource;

     protected $_dir;
     private $io;
     /**
      * Courses constructor.
      *
      * @param JsonHelper $jsonHelper
      * @param ImportHelper $importExportData
      * @param Data $importData
      * @param ResourceConnection $resource
      * @param Helper $resourceHelper
      * @param ProcessingErrorAggregatorInterface $errorAggregator
      */
     public function __construct(
         JsonHelper $jsonHelper,
         ImportHelper $importExportData,
         Data $importData,
         ResourceConnection $resource,
         Helper $resourceHelper,
         ProcessingErrorAggregatorInterface $errorAggregator,
         Filesystem $filesystem,
         DirectoryList $dir,
         File $io,
         \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     ) {
         $this->filesystem = $filesystem;
         $this->io= $io;
         $this->_dir = $dir;
         $this->jsonHelper = $jsonHelper;
         $this->_importExportData = $importExportData;
         $this->_resourceHelper = $resourceHelper;
         $this->_dataSourceModel = $importData;
         $this->resource = $resource;
         $this->connection = $resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
         $this->errorAggregator = $errorAggregator;
         $this->scopeConfig = $scopeConfig;
      }

     /**
      * Entity type code getter.
      *
      * @return string
      */
     public function getEntityTypeCode()
     {
         return static::ENTITY_CODE;
     }

     /**
      * Get available columns
      *
      * @return array
      */
     public function getValidColumnNames(): array
     {
         return $this->validColumnNames;
     }

     /** Get all increment id from database*/
        public function getincrementid()
        {
            $tableName = $this->resource->getTableName('sales_order_grid');

            //Initiate Connection
            $connection = $this->resource->getConnection();
            $sql = "SELECT increment_id FROM ". $tableName;
            $result = $connection->fetchCol($sql);

//            Convert multidimensional array into single array
            // $array = array_column($result, 'increment_id');
//            die(var_dump($array));
            return $result;
        }

     /**
      * Row validation
      *
      * @param array $rowData
      * @param int $rowNum
      *
      * @return bool
      */
     public function validateRow(array $rowData, $rowNum): bool
     {
        $id =substr($rowData['incrementid'],1 ?? '');
        $orderIds= $this -> getincrementid();
          if (!in_array($id,$orderIds))
          {
              $this->addRowError(' InvalidIncrementId', $rowNum);
          }

         if (isset($this->_validatedRows[$rowNum])) {
             return !$this->getErrorAggregator()->isRowInvalid($rowNum);
         }

         $this->_validatedRows[$rowNum] = true;

         return !$this->getErrorAggregator()->isRowInvalid($rowNum);
     }

     /**
      * Import data
      *
      * @return bool
      *
      * @throws Exception
      */
     protected function _importData(): bool
     {
         switch ($this->getBehavior()) {
             case Import::BEHAVIOR_DELETE:
                 $this->deleteEntity();
                 break;
             case Import::BEHAVIOR_REPLACE:
                 $this->saveAndReplaceEntity();
                 break;
             case Import::BEHAVIOR_APPEND:
                 $this->saveAndReplaceEntity();
                 break;
         }

         return true;
     }

     /**
      * Delete entities
      *
      * @return bool
      */
     private function deleteEntity(): bool
     {
         $rows = [];
         while ($bunch = $this->_dataSourceModel->getNextBunch()) {
             foreach ($bunch as $rowNum => $rowData) {
                 $this->validateRow($rowData, $rowNum);

                 if (!$this->getErrorAggregator()->isRowInvalid($rowNum)) {
                     $rowId = $rowData[static::ENTITY_ID_COLUMN];
                     $rows[] = $rowId;
                 }

                 if ($this->getErrorAggregator()->hasToBeTerminated()) {
                     $this->getErrorAggregator()->addRowToSkip($rowNum);
                 }
             }
         }

         if ($rows) {
             return $this->deleteEntityFinish(array_unique($rows));
         }

         return false;
     }

     /**
      * Save and replace entities
      *
      * @return void
      */
     private function saveAndReplaceEntity()
     {
         $behavior = $this->getBehavior();
         $rows = [];
         while ($bunch = $this->_dataSourceModel->getNextBunch()) {
             $entityList = [];

             foreach ($bunch as $rowNum => $row) {
                 if (!$this->validateRow($row, $rowNum)) {
                     continue;
                 }

                 if ($this->getErrorAggregator()->hasToBeTerminated()) {
                     $this->getErrorAggregator()->addRowToSkip($rowNum);

                     continue;
                 }

                 $rowId = $row[static::ENTITY_ID_COLUMN];
                 $incrementid=substr($row[static::INCREMENTID],1);
                 $rows[] = $incrementid;

                 $valueFromConfig = $this->scopeConfig->getValue(
                    'size/general/size',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

                 $writer = new PngWriter();
                        // Create QR code
                        $qrCode = QrCode::create($incrementid)
                        ->setEncoding(new Encoding('UTF-8'))
                        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                        ->setSize($valueFromConfig)
                        ->setMargin(10)
                        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                        ->setForegroundColor(new Color(0, 0, 0))
                        ->setBackgroundColor(new Color(255, 255, 255));

                        // Create generic logo
                        $logo = Logo::create(__DIR__.'/assets/symfony.png')
                            ->setResizeToWidth(50);

                        // Create generic label
                        $label = Label::create('Label')
                            ->setTextColor(new Color(255, 0, 0));

                        $result = $writer->write($qrCode, $logo, $label);

                        $mediapath = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
                        $this->io->mkdir($this->_dir->getPath('media').'/qrcode', 0777);
                        $result->saveToFile($mediapath . 'qrcode/'. $incrementid .'.png');

             }
         }
     }

     /**
      * Save entities
      *
      * @param array $entityData
      *
      * @return bool
      */


     /**
      * Get available columns
      *
      * @return array
      */
     private function getAvailableColumns(): array
     {
         return $this->validColumnNames;
     }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        // TODO: Implement execute() method.
    }
}
