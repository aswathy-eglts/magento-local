<?php
namespace Egits\Override\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id_column';
	protected $_eventPrefix = 'customer_login_demo_table';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Egits\Override\Model\Post', 'Egits\Override\Model\ResourceModel\Post');
	}

}
