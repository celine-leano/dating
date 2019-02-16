<?php
/**
 * PremiumMember class that has access to interest fields
 * @author Celine Leano
 */

class PremiumMember extends Member
{
    private $_indoorInterests;
    private $_outdoorInterests;

    /**
     * PremiumMember constructor.
     * @param $fname
     * @param $lname
     * @param $age
     * @param $gender
     * @param $phone
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        parent::__construct($fname, $lname, $age, $gender, $phone);
    }

    /**
     * Returns indoor interests
     * @return mixed
     */
    public function getIndoorInterests()
    {
        return $this->_indoorInterests;
    }

    /**
     * Sets indoor interests
     * @param mixed $indoorInterests
     */
    public function setIndoorInterests($indoorInterests)
    {
        $this->_indoorInterests = $indoorInterests;
    }

    /**
     * Returns outdoor interests
     * @return mixed
     */
    public function getOutdoorInterests()
    {
        return $this->_outdoorInterests;
    }

    /**
     * Sets outdoor interests
     * @param mixed $outdoorInterests
     */
    public function setOutdoorInterests($outdoorInterests)
    {
        $this->_outdoorInterests = $outdoorInterests;
    }
}