<?php
namespace Egits\Override\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'customer_login_demo_table';

	protected $_cacheTag = 'customer_login_demo_table';

	protected $_eventPrefix = 'customer_login_demo_table';

	protected function _construct()
	{
		$this->_init('Egits\Override\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}