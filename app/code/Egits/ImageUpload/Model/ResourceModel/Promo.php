<?php
namespace Egits\ImageUpload\Model\ResourceModel;

class Promo extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('promoimage_table', 'id');
	}
	
}