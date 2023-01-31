<?php

namespace Egits\EmployeeForm\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Egits\EmployeeForm\Model\Post;
use Egits\EmployeeForm\Model\ResourceModel\Post as Resourcepost;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends \Magento\Backend\App\Action
{
    private $dataPersistor;
    protected $uiExamplemodel;
    /**
     * @var Session
     */
    protected $adminsession;

    /**
     * @param Action\Context $context
     * @param Session $adminsession
     */
    public function __construct(
        Action\Context $context,
        Post $uiExamplemodel,
        Session $adminsession,
        Resourcepost $resourcepost,
        DataPersistorInterface $dataPersistor
        ) {
        parent::__construct($context);
        $this->uiExamplemodel = $uiExamplemodel;
        $this->adminsession = $adminsession;
        $this->Resourcepost = $resourcepost;
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * Save record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $this->dataPersistor->set('uiexample', $data);
        $resultRedirect = $this->resultRedirectFactory->create();

              if ($this -> validatedParams() != null) {

                  $resultRedirect->setRefererOrBaseUrl();
                  return $resultRedirect;
              }
              else {
                  $save = $this->uiExamplemodel->setData($data);
                  try {
                      $this->Resourcepost->save($save);
                      $this->messageManager->addSuccessMessage(__('The data has been saved.'));
                      $this->dataPersistor->clear('uiexample');
                      return $resultRedirect->setPath('*/*/');

                  } catch (\Magento\Framework\Exception\LocalizedException $e) {
                      $this->messageManager->addErrorMessage($e->getMessage());
                  } catch (\RuntimeException $e) {
                      $this->messageManager->addErrorMessage($e->getMessage());
                  } catch (\Exception $e) {
                      $this->messageManager->addErrorMessage($e, __('Something went wrong while saving the data.'));
                  }

                  return $resultRedirect->setPath('*/*/');
              }

    }
          #server side validation

        private function validatedParams()
        {

            $request = $this->getRequest();
            $data=[];
            if (!preg_match("/^[a-zA-Z]{2,}+$/",$request->getParam('employee_name')))
            {
              $data=$this->messageManager->addErrorMessage( __('Name is missing'));
            }
            if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$request->getParam('employe_email')))
            {
                $data= $this->messageManager->addErrorMessage(__('Invalid email address'));
            }
            if (!preg_match("/^[A-Za-z]+[A-Za-z0-9\-\\,. ]{5,}+$/",$request->getParam('employee_address')))
            {
               $data= $this->messageManager->addErrorMessage( __('Address is missing'));
            }
            foreach ($data as $datas)
            {
               $this->messageManager->addErrorMessage($datas);
            }
     return $data;
        }

}
