<?php
/*
 * Celine Leano
 * 2/16/2019
 * 328/dating/classes/member.php
 * Member class
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
     * @return First
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param First $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return Last
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param Last $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return Age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param Age $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return Gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param Gender $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return Phone
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param Phone $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return mixed
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}