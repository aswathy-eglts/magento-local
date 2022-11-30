<?php
namespace Egits\EventObserver\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'url_count';

    const url='url';
	const count='count'; 
	const ID='id'; 
	protected $_cacheTag = 'url_count';

	protected $_eventPrefix = 'url_count';

	protected function _construct()
	{
		$this->_init('Egits\EventObserver\Model\ResourceModel\Post');
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

    public function getUrl()
    {
        return $this->getData(self::url);
    }
	
    public function getCount()
    {
        return $this->getData(self::count);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
	
    public function setUrl($url)
    {
        return $this->setData(self::url, $url);
    }
	
    public function setCount($count)
    {
        return $this->setData(self::count, $count);
    }
	
}