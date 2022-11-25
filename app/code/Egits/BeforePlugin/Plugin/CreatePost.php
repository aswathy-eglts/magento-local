<?php
namespace Egits\BeforePlugin\Plugin;
use Magento\Customer\Model\Registration;
use Magento\Framework\App\RequestInterface;
// use Egits\BeforePlugin\Logger\Logger;

class CreatePost
    {

        protected $logger;
        protected $registration;
        public function __construct(
             \Egits\BeforePlugin\Logger\Logger $logger,
            Registration $registration,RequestInterface $request
            )
        {
            $this->registration = $registration;
            $this->request = $request;
             $this->logger = $logger;

        }
        public function beforeExecute(
            \Magento\Customer\Controller\Account\CreatePost $subject )
            {

                // $value = $this->request->getParam('phone_number');
                // $this->logger->info("test");
                // die($value);
                //     $this->logger->info($value);


            }
    }
