<?php
namespace Egits\QrCode\ViewModel;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class OrderIncrement implements ArgumentInterface
{

    public $scopeConfig;
    
    public function __construct(
      
        \Magento\Store\Model\StoreManagerInterface $storeManager,
    
    ) {
        $this->storeManager = $storeManager;
    }


    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMediaUrl()
    {
        $mediaurl= $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $mediaurl;
    }
    
}
