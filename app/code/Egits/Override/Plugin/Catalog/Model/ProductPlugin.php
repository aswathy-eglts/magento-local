<?php

namespace Egits\Override\Plugin\Catalog\Model;

use Magento\Catalog\Model\Product;

class ProductPlugin
{
public function afterGetName(Product $subject, $result)
{
return  'magento ' .$result;
}
}