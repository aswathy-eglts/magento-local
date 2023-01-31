<?php
namespace Egits\ImageUpload\Model\ResourceModel\Promo;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'promoimage_table';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Egits\ImageUpload\Model\Promo', 'Egits\ImageUpload\Model\ResourceModel\Promo');
	}

}