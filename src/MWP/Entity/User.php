<?php

namespace MWP\Entity;

class User
{
    /**
     * @var int
     */
    protected $ID;

    /**
     * @var string
     */
    protected $user_login;

    /**
     * @var string
     */
    protected $user_pass;

    /**
     * @var string
     */
    protected $user_nicename;

    /**
     * @var string
     */
    protected $user_email;

    /**
     * @var string
     */
    protected $user_url;

    /**
     * @var string
     */
    protected $user_registered;

    /**
     * @var string
     */
    protected $user_activation_key;

    /**
     * @var int
     */
    protected $user_status;

    /**
     * @var string
     */
    protected $display_name;


    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param string $display_name
     */
    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

    /**
     * @param string $user_activation_key
     */
    public function setUserActivationKey($user_activation_key)
    {
        $this->user_activation_key = $user_activation_key;
    }

    /**
     * @return string
     */
    public function getUserActivationKey()
    {
        return $this->user_activation_key;
    }

    /**
     * @param string $user_email
     */
    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }

    /**
     * @return string
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param string $user_login
     */
    public function setUserLogin($user_login)
    {
        $this->user_login = $user_login;
    }

    /**
     * @return string
     */
    public function getUserLogin()
    {
        return $this->user_login;
    }

    /**
     * @param string $user_nicename
     */
    public function setUserNicename($user_nicename)
    {
        $this->user_nicename = $user_nicename;
    }

    /**
     * @return string
     */
    public function getUserNicename()
    {
        return $this->user_nicename;
    }

    /**
     * @param string $user_pass
     */
    public function setUserPass($user_pass)
    {
        $this->user_pass = $user_pass;
    }

    /**
     * @return string
     */
    public function getUserPass()
    {
        return $this->user_pass;
    }

    /**
     * @param string $user_registered
     */
    public function setUserRegistered($user_registered)
    {
        $this->user_registered = $user_registered;
    }

    /**
     * @return string
     */
    public function getUserRegistered()
    {
        return $this->user_registered;
    }

    /**
     * @param int $user_status
     */
    public function setUserStatus($user_status)
    {
        $this->user_status = $user_status;
    }

    /**
     * @return int
     */
    public function getUserStatus()
    {
        return $this->user_status;
    }

    /**
     * @param string $user_url
     */
    public function setUserUrl($user_url)
    {
        $this->user_url = $user_url;
    }

    /**
     * @return string
     */
    public function getUserUrl()
    {
        return $this->user_url;
    }


}

