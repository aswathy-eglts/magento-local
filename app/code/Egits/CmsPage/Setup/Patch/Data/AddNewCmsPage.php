<?php

namespace Egits\CmsPage\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\PageFactory;


class AddNewCmsPage implements DataPatchInterface
{
   
    private $moduleDataSetup;
    private $pageFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        PageFactory $pageFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->pageFactory = $pageFactory;
    }


    public function apply()
    {
        $pageData = [
            'title' => 'Custom Page Title',
            'page_layout' => '1column',
            'meta_keywords' => 'Page keywords',
            'meta_description' => 'Page description',
            'identifier' => 'custom-page',
            'content_heading' => 'Custom Page',
            'content' => '<div class="main-cms-content">Content goes here for My cms page. CMS Page create using Programmatically.
            <img src="{{media url=wysiwyg/image.png}}"/> </div>',
            'layout_update_xml' => '',
            'url_key' => 'custom-page',
            'is_active' => 1,
            'stores' => [0], // store_id comma separated
            'sort_order' => 0
        ];

        $this->moduleDataSetup->startSetup();
        /* Save CMS Page logic */
        $this->pageFactory->create()->setData($pageData)->save();
        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public static function getVersion()
    {
        return '2.0.0';
    }

    public function getAliases()
    {
        return [];
    }
}
?>