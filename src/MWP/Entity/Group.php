<?php

namespace MWP\Entity;

class Group
{
    /**
     * @var int
     */
    protected $ID;

    /**
     * @var string
     */
    protected $group_name;

    /**
     * @var int
     */
    protected $user_id;

    /**
     * @var array
     */
    protected $site_ids;


    public function __construct()
    {
        if ($this->site_ids !== null) {
            $this->site_ids = explode(',', $this->site_ids);
        }
    }

    /**
     * @param int $ID
     */
    public function setID($ID)
    {
        $this->ID = $ID;
    }

    /**
     * @return int
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @param string $group_name
     */
    public function setGroupName($group_name)
    {
        $this->group_name = $group_name;
    }

    /**
     * @return string
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param array $site_ids
     */
    public function setSiteIds(array $site_ids)
    {
        $this->site_ids = $site_ids;
    }

    /**
     * @return array
     */
    public function getSiteIds()
    {
        return $this->site_ids;
    }
}