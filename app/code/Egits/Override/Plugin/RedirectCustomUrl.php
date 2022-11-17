<?php
namespace Egits\Override\Plugin;

class RedirectCustomUrl
{
    public function afterExecute(
        \Magento\Customer\Controller\Account\LoginPost $subject,
        $result)
    {
        $customUrl = 'sales/order/history';
        $result->setPath($customUrl);
        return $result;
    }
}