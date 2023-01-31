<?php
namespace Egits\EmployeeForm\Api\Data;

interface ViewInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const name='employee_name';
	const email='employe_email'; 
    const address='employee_address'; 
	const ID='employee_id'; 
    /**#@-*/


    /**
     * Get Title
     *
     * @return string|null
     */
    public function getName();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getAddress();

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setName($employee_name);

    /**
     * Set Content
     *
     * @param string $content
     * @return $this
     */
    public function setEmail($employe_email);

    /**
     * Set Crated At
     *
     * @param int $createdAt
     * @return $this
     */
    public function setAddress($employee_address);

    /**
     * Set ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($employee_id);
}