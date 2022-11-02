<?php
namespace Egits\HelloWorld\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'declarative_table';

	protected $_cacheTag = 'declarative_table';

	protected $_eventPrefix = 'declarative_table';

	protected function _construct()
	{
		$this->_init('Egits\HelloWorld\Model\ResourceModel\Post');
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
