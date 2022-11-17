<?php
namespace Egits\Override\Plugin;

class Plugin 
{
   protected $_messageManager;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory
    ) 
    {
        $this->_messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
    }

  public function beforeExecute(
    \Magento\Cms\Controller\Page\View $subject,)
  {
    $resultRedirect = $this->resultRedirectFactory->create();
    $resultRedirect->setPath('customer/account/login');
    return $resultRedirect;
  }
}