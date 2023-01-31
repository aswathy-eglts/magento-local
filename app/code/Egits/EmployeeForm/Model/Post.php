<?php
namespace Egits\EmployeeForm\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'employee_table';

    const name='employee_name';
	const email='employe_email'; 
    const address='employee_address'; 
	const ID='employee_id'; 
	protected $_cacheTag = 'employee_table';

	protected $_eventPrefix = 'employee_table';

	protected function _construct()
	{
		$this->_init('Egits\EmployeeForm\Model\ResourceModel\Post');
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

    public function getName()
    {
        return $this->getData(self::name);
    }
	
    public function getEmail()
    {
        return $this->getData(self::email);
    }

    public function getAddress()
    {
        return $this->getData(self::address);
    }

    public function setId($employee_id)
    {
        return $this->setData(self::ID, $employee_id);
    }
	
    public function setName($employee_name)
    {
        return $this->setData(self::name, $employee_name);
    }
	
    public function setEmail($employe_email)
    {
        return $this->setData(self::email, $employe_email);
    }

    public function setAddress($employee_address)
    {
        return $this->setData(self::address, $employee_address);
    }
	
}