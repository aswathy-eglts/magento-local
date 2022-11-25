<?php
namespace Egits\Before\Plugin;
use Magento\Customer\Model\Registration;
use Magento\Framework\App\RequestInterface;

class CreatePost
    {
        protected $logger;
        protected $registration;
        public function __construct(
            \Egits\Before\Logger\Logger $logger,
            Registration $registration,RequestInterface $request,
            
            )
        {
            $this->registration = $registration;
            $this->request = $request;
            $this->logger = $logger;
            
        }
        public function beforeExecute(
            \Magento\Customer\Controller\Account\CreatePost $subject )
            {

                $value = $this->request->getParam('phone_number');
                $this->logger->warning($value);
                            
            }
    }
