<?php
namespace Egits\CmsBlock\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddColumn implements SchemaPatchInterface
{
   private $moduleDataSetup;

   public function __construct(
       ModuleDataSetupInterface $moduleDataSetup
   ) {
       $this->moduleDataSetup = $moduleDataSetup;
   }

   public static function getDependencies()
   {
       return [];
   }

   public function getAliases()
   {
       return [];
   }

   public function apply()
   {
       $this->moduleDataSetup->startSetup();

       $this->moduleDataSetup->getConnection()->addColumn(
           $this->moduleDataSetup->getTable('demotable'),
           'surname',
           [
               'type' => Table::TYPE_TEXT,
               'length' => 255,
               'nullable' => true,
               'comment'  => 'Name',
           ]
       );

       $this->moduleDataSetup->endSetup();
   }
}