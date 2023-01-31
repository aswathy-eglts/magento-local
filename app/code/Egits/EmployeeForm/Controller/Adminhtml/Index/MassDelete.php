<?php
namespace Egits\EmployeeForm\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Egits\EmployeeForm\Model\ResourceModel\Post\CollectionFactory;
use Egits\EmployeeForm\Model\ResourceModel\PostFactory as Resourcepost;

class MassDelete extends Action
{
    public $collectionFactory;

    public $filter;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        \Egits\EmployeeForm\Model\PostFactory $postFactory,
        Resourcepost $resourcepost
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->postFactory = $postFactory;
        $this->Resourcepost = $resourcepost;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());

            $count = 0;
            foreach ($collection as $model) {
                $postModel = $this->postFactory->create();
                $resourceModel = $this->Resourcepost->create();
                $resourceModel->load($postModel,$model->getEmployeeId()); // for load
                $resourceModel->delete( $postModel); // for delete
                $count++;
            }
            $this->messageManager->addErrorMessage(__('A total of %1 data(s) have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Egits_EmployeeForm::delete');
    }
}
