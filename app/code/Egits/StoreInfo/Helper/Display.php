<?php
/**
 * Created By : Rohan Hapani
 */
namespace Egits\StoreInfo\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Display extends AbstractHelper
{
    const XML_PATH_STORE_NAME = 'general/store_information/name';
    const XML_PATH_STORE_PHONE = 'general/store_information/phone';
    const XML_PATH_STORE_HOURS = 'general/store_information/hours';
    const XML_PATH_STORE_COUNTRY = 'general/store_information/country_id';
    const XML_PATH_STORE_REGION = 'general/store_information/region_id';
    const XML_PATH_STORE_POSTCODE = 'general/store_information/postcode';
    const XML_PATH_STORE_CITY = 'general/store_information/city';
    const XML_PATH_STORE_STREET_ADDRESS1 = 'general/store_information/street_line1';
    const XML_PATH_STORE_STREET_ADDRESS2 = 'general/store_information/street_line2';
    // const XML_PATH_STORE_VAT_NUMBER = 'general/store_information/merchant_vat_number';

    public function getName()
    {
        $configValues = $this->scopeConfig->getValue(self::XML_PATH_STORE_NAME, ScopeInterface::SCOPE_STORE); // For Store
        /**
         * For Website
         *
         * $configValue = $this->scopeConfig->getValue(self::XML_CONFIG_PATH,ScopeInterface::SCOPE_WEBSITE);
         */
        return $configValues;
    }
    public function getPhone()
        {
            $configValue = $this->scopeConfig->getValue(self::XML_PATH_STORE_PHONE ,ScopeInterface::SCOPE_STORE); // For Store

           return $configValue;
       }
       
       public function getHours()
       {
           $configValue = $this->scopeConfig->getValue(self::XML_PATH_STORE_HOURS ,ScopeInterface::SCOPE_STORE); // For Store
           return $configValue;

       }
           public function getCountry()
           {
               $configValue = $this->scopeConfig->getValue(self::XML_PATH_STORE_COUNTRY ,ScopeInterface::SCOPE_STORE); // For Store
    
              return $configValue;
          } 
      
        public function getCity()
        {
            $configValue = $this->scopeConfig->getValue(self::XML_PATH_STORE_CITY,ScopeInterface::SCOPE_STORE); // For Store

           return $configValue;
       }
       public function getRegion()
        {
            $configValue = $this->scopeConfig->getValue(self::XML_PATH_STORE_REGION,ScopeInterface::SCOPE_STORE); // For Store

           return $configValue;
       }
}
