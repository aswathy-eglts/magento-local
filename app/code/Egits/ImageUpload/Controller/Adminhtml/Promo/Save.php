<?php
namespace Egits\ImageUpload\Controller\Adminhtml\Promo;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\Framework\Validation\ValidationException;
use Magento\MediaStorage\Model\File\UploaderFactory;
class Save extends \Magento\Backend\App\Action
{
   protected $promoFactory;
   protected $adapterFactory;
   protected $uploader;
   public function __construct(
   \Magento\Backend\App\Action\Context $context,
   \Egits\ImageUpload\Model\PromoFactory $promoFactory,
   UploaderFactory $uploaderFactory,
   Filesystem $filesystem
   ) {
       parent::__construct($context);
       $this->promoFactory = $promoFactory;
       $this->uploaderFactory = $uploaderFactory;
       $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
 
   }
   public function execute()
   {
       $data = $this->getRequest()->getParams();
 
       $detail = $data['description'];
       //die($enab);
       try {
           $fileUploader = null;
           $model = $this->promoFactory->create();
           if (isset($data['image']) && count($data['image'])) {
           $imageId = $data['image'][0];
           if (!file_exists($imageId['tmp_name'])) {
           $imageId['tmp_name'] = $imageId['path'] . '/' . $imageId['file'];
           }
           }
           $fileUploader = $this->uploaderFactory->create(['fileId' => $imageId]);
           $fileUploader->setAllowedExtensions(['jpg', 'jpeg', 'png']);
           $fileUploader->setAllowRenameFiles(true);
           $fileUploader->setAllowCreateFolders(true);
           $fileUploader->validateFile();
           //upload image
           $info = $fileUploader->save($this->mediaDirectory->getAbsolutePath('imageUploader/images'));
           $model->setImage($this->mediaDirectory->getRelativePath('imageUploader/images') . '/' . $info['file']);
           $model->save();
            $saveData = $model->setDescription($detail)->save();
           if($saveData){
           $this->messageManager->addSuccess( __('Insert data Successfully !') );
           }
       }catch (\Exception $e) {
           $this->messageManager->addError(__($e->getMessage()));
       }
       $this->_redirect('*/*/index');
   }
}
