<?php

namespace Egits\EmployeeForm\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Egits\EmployeeForm\Model\PostFactory;
use Egits\EmployeeForm\Model\ResourceModel\PostFactory as Resourcepost;

class Delete extends Action
{
    public $postFactory;
    private $resourcepost;

    public function __construct(
        Context $context,
        PostFactory $postFactory,
        Resourcepost $resourcepost

    ) {
        $this->postFactory = $postFactory;
        $this->Resourcepost = $resourcepost;

        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        try {
            $postModel = $this->postFactory->create();
            $resourceModel = $this->Resourcepost->create();
            $resourceModel->load($postModel, $id); // for load
            $resourceModel->delete($postModel); // for delete
            
            $this->messageManager->addSuccessMessage(__('Successfully deleted .'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        return $resultRedirect->setPath('*/*/');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Egits_EmployeeForm::delete');
    }
}
