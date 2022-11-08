<?php
namespace Egits\CmsBlock\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class UpdateAttribute implements DataPatchInterface
{
   private $_moduleDataSetup;

   private $_eavSetupFactory;

   public function __construct(
       ModuleDataSetupInterface $moduleDataSetup,
       EavSetupFactory $eavSetupFactory
   ) {
       $this->_moduleDataSetup = $moduleDataSetup;
       $this->_eavSetupFactory = $eavSetupFactory;
   }

   public function apply()
   {
       /** @var EavSetup $eavSetup */
         $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_moduleDataSetup]);

       $eavSetup->updateAttribute(Product::ENTITY, 
       'Discount',
        [
           'frontend_label' => 'Discount',
           'input' => 'text',
           
        ]
         );
    }

   public static function getDependencies()
   {
       return [];
   }

   public function getAliases()
   {
       return [];
   }

   public static function getVersion()
   {
      return '1.0.0';
   }
}