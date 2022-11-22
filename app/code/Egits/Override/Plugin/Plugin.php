<?php
namespace Egits\Override\Plugin;

class Plugin 
{

  public function beforeExecute(
    \Magento\Cms\Controller\Page\View $subject)
  {
    
    die('error');
  }
}