<?php
namespace Egits\BeforePlugin\Logger;

use Monolog\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{
   /**
    * Logging level
    * @var int
    */
   protected $loggerType = Logger::NOTICE;

   /**
    * File name
    * @var string
    */
   protected $fileName = '/var/log/egits_log.log';
}
