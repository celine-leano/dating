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
     * @return mixed First name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * Set first name
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return mixed Last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * Set last name
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return mixed Age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * Set age
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return mixed Gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * Set gender
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return mixed Phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * Set phone number
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed Email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Set email
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed State
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Set state
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return mixed Seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * Set seeking
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return mixed Biography
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * Set biography
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }
}