<?php
namespace Egits\HelloWorld\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id_column';
	protected $_eventPrefix = 'declarative_table';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Egits\HelloWorld\Model\Post', 'Egits\HelloWorld\Model\ResourceModel\Post');
	}

}
