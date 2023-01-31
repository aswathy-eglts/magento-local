<?php

namespace Egits\ImageUpload\Model;
class Promo extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'promoimage_table';

    const ID='id'; 
    const description='description';
	const image='image'; 
	
	protected $_cacheTag = 'promoimage_table';

	protected $_eventPrefix = 'promoimage_table';

	protected function _construct()
	{
		$this->_init('Egits\ImageUpload\Model\ResourceModel\Promo');
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

    public function getDescription()
    {
        return $this->getData(self::description);
    }
	
    public function getImage()
    {
        return $this->getData(self::image);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }
	
    public function setDescription($description)
    {
        return $this->setData(self::description, $description);
    }
	
    public function setImage($image)
    {
        return $this->setData(self::image, $image);
    }
	
}