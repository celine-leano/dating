<?php
/**
 * Member class that stores an object with fields adjacent to
 * the sign-up form
 * @author Celine Leano
 */

class Member
{
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param $fname First name
     * @param $lname Last name
     * @param $age Age
     * @param $gender Gender
     * @param $phone Phone number
     */
    function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->_fname = $fname;
        $this->_lname = $lname;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
    }

    /**
     * Returns first name
     * @return mixed $fname
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Sets first name
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * Returns last name
     * @return mixed $lname
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Sets last name
     * @param $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * Returns age
     * @return mixed $age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Sets age
     * @param $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * Returns gender
     * @return mixed $gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Sets gender
     * @param $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * Returns phone number
     * @return mixed $phone
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Sets phone number
     * @param $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * Returns email address
     * @return mixed $email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets email address
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * Returns state
     * @return mixed $state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Sets state
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * Returns seeking
     * @return mixed $seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Sets seeking
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * Returns biography
     * @return mixed $bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Sets biography
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }

}