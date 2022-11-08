<?php
namespace Egits\CmsBlock\Setup\Patch\Data;
use Magento\Framework\Setup\Patch\DataPatchInterface;

use Magento\Framework\Setup\Patch\PatchVersionInterface;

use Magento\Framework\Setup\ModuleDataSetupInterface;

use Magento\Cms\Model\BlockFactory;

class InstallData implements DataPatchInterface, PatchVersionInterface

{
    private $moduleDataSetup;
    private $blockFactory;

    public function __construct(

        ModuleDataSetupInterface $moduleDataSetup,

        BlockFactory $blockFactory

    ) {

        $this->moduleDataSetup = $moduleDataSetup;

        $this->blockFactory = $blockFactory;

    }


    public function apply()

    {

        $newCmsStaticBlock = [

            'title' => 'CMS Block',

            'identifier' => 'example-cms-block',

            'content' => '<div class="cms-block">Added a CMS Block </div>',

            'is_active' => 1,

            'stores' => \Magento\Store\Model\Store::DEFAULT_STORE_ID

        ];

 

        $this->moduleDataSetup->startSetup();

 

        /** @var \Magento\Cms\Model\Block $block */

        $block = $this->blockFactory->create();

        $block->setData($newCmsStaticBlock)->save();

 

        $this->moduleDataSetup->endSetup();

    }

 

    /**

    * {@inheritdoc}

    */

    public static function getDependencies()

    {

        return [];

    }

 

    /**

    * {@inheritdoc}

    */

    public static function getVersion()

    {

        return '2.0.0';

    }

 

    /**

    * {@inheritdoc}

    */

    public function getAliases()

    {

        return [];

    }

}
