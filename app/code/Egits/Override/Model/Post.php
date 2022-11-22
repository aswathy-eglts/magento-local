<?php
namespace Egits\Override\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'customer_login_demo_table';
	const Login_attempt='Login_attempt';
	const Email='Email';
	const time_occurred='time_occurred';
	const update_time='update_time'; 
	const ID='id_column'; 

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
	public function getEmail()
    {
        return $this->getData(self::Email);
    }
	
	public function getTime_occurred()
    {
        return $this->getData(self::time_occurred);
    }

	public function getUpdate_time()
    {
        return $this->getData(self::update_time);
    }

	public function getLogin_attempt()
    {
        return $this->getData(self::Login_attempt);
    }

	public function setId($id_column)
    {
        return $this->setData(self::ID, $id_column);
    }

	public function setEmail($Email)
    {
        return $this->setData(self::Email, $Email);
    }

	public function setTime_occurred($time_occurred)
    {
        return $this->setData(self::time_occurred, $time_occurred);
    }

		public function setUpdate_time($update_time)
    {
        return $this->setData(self::update_time, $update_time);
    }

	public function setLogin_attempt($Login_attempt)
    {
        return $this->setData(self::Login_attempt, $Login_attempt);
    }
}