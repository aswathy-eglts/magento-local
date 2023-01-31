<?php
namespace Egits\EmployeeForm\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'employee_id';
	protected $_eventPrefix = 'employee_table';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Egits\EmployeeForm\Model\Post', 'Egits\EmployeeForm\Model\ResourceModel\Post');
	}

}