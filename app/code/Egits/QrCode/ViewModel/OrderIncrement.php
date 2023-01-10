<?php
namespace Egits\QrCode\ViewModel;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class OrderIncrement implements ArgumentInterface
{

    public $scopeConfig;
    
    public function __construct(
      
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,

    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;

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

    
    public function getqrcodesize()
    {
        
        $valueFromConfig = $this->scopeConfig->getValue(
            'size/general/size',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            return $valueFromConfig;
    }
    
}
