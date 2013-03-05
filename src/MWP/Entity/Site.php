<?php

namespace MWP\Entity;

class Site
{
    /**
     * @var int
     */
    protected $ID;

    /**
     * @var string
     */
    protected $wp_url;

    /**
     * @var string
     */
    protected $wp_admin_url;

    /**
     * @var string
     */
    protected $site_ip;

    /**
     * @var string
     */
    protected $wp_username;

    /**
     * @var string
     */
    protected $wp_password;

    /**
     * @var string
     */
    protected $wp_title;

    /**
     * @var string
     */
    protected $wp_description;

    /**
     * @var string
     */
    protected $db_name;

    /**
     * @var string
     */
    protected $ftp_host;

    /**
     * @var string
     */
    protected $ftp_username;

    /**
     * @var string
     */
    protected $ftp_password;

    /**
     * @var string
     */
    protected $site_key;

    /**
     * @var boolean
     */
    protected $is_readonly;

    /**
     * @var boolean
     */
    protected $is_ftp_site;

    /**
     * @var string
     */
    protected $ftp_home_dir;

    /**
     * @var string
     */
    protected $worker_path;

    /**
     * @var string
     */
    protected $content_path;

    /**
     * @var string
     */
    protected $backup_manual;

    /**
     * @var string
     */
    protected $backup_daily;

    /**
     * @var string
     */
    protected $backup_weekly;

    /**
     * @var string
     */
    protected $backup_timestamp;

    /**
     * @var string
     */
    protected $auto_backups;

    /**
     * @var string
     */
    protected $table_optimization;

    /**
     * @var string
     */
    protected $worker_version;

    /**
     * @var boolean
     */
    protected $secure_transfer;

    /**
     * @var int
     */
    protected $message_id;

    /**
     * @var string
     */
    protected $note;

    /**
     * @var string
     */
    protected $random_worker_key;

    /**
     * @var string
     */
    protected $google_analytics_id;

    /**
     * @var string
     */
    protected $site_color;

    /**
     * @var string
     */
    protected $notification_key;

    /**
     * @var string
     */
    protected $multisite;

    /**
     * @var string
     */
    protected $multisite_network;

    /**
     * @var string
     */
    protected $site_added;

    /**
     * @var array
     */
    protected $group_ids;


    public function __construct()
    {
        if ($this->group_ids !== null) {
            $this->group_ids = explode(',', $this->group_ids);
        }
    }

    public function getId()
    {
        return $this->ID;
    }

    /**
     * @param string $auto_backups
     */
    public function setAutoBackups($auto_backups)
    {
        $this->auto_backups = $auto_backups;
    }

    /**
     * @return string
     */
    public function getAutoBackups()
    {
        return $this->auto_backups;
    }

    /**
     * @param string $backup_daily
     */
    public function setBackupDaily($backup_daily)
    {
        $this->backup_daily = $backup_daily;
    }

    /**
     * @return string
     */
    public function getBackupDaily()
    {
        return $this->backup_daily;
    }

    /**
     * @param string $backup_manual
     */
    public function setBackupManual($backup_manual)
    {
        $this->backup_manual = $backup_manual;
    }

    /**
     * @return string
     */
    public function getBackupManual()
    {
        return $this->backup_manual;
    }

    /**
     * @param string $backup_timestamp
     */
    public function setBackupTimestamp($backup_timestamp)
    {
        $this->backup_timestamp = $backup_timestamp;
    }

    /**
     * @return string
     */
    public function getBackupTimestamp()
    {
        return $this->backup_timestamp;
    }

    /**
     * @param string $backup_weekly
     */
    public function setBackupWeekly($backup_weekly)
    {
        $this->backup_weekly = $backup_weekly;
    }

    /**
     * @return string
     */
    public function getBackupWeekly()
    {
        return $this->backup_weekly;
    }

    /**
     * @param string $content_path
     */
    public function setContentPath($content_path)
    {
        $this->content_path = $content_path;
    }

    /**
     * @return string
     */
    public function getContentPath()
    {
        return $this->content_path;
    }

    /**
     * @param string $db_name
     */
    public function setDbName($db_name)
    {
        $this->db_name = $db_name;
    }

    /**
     * @return string
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @param string $ftp_home_dir
     */
    public function setFtpHomeDir($ftp_home_dir)
    {
        $this->ftp_home_dir = $ftp_home_dir;
    }

    /**
     * @return string
     */
    public function getFtpHomeDir()
    {
        return $this->ftp_home_dir;
    }

    /**
     * @param string $ftp_host
     */
    public function setFtpHost($ftp_host)
    {
        $this->ftp_host = $ftp_host;
    }

    /**
     * @return string
     */
    public function getFtpHost()
    {
        return $this->ftp_host;
    }

    /**
     * @param string $ftp_password
     */
    public function setFtpPassword($ftp_password)
    {
        $this->ftp_password = $ftp_password;
    }

    /**
     * @return string
     */
    public function getFtpPassword()
    {
        return $this->ftp_password;
    }

    /**
     * @param string $ftp_username
     */
    public function setFtpUsername($ftp_username)
    {
        $this->ftp_username = $ftp_username;
    }

    /**
     * @return string
     */
    public function getFtpUsername()
    {
        return $this->ftp_username;
    }

    /**
     * @param string $google_analytics_id
     */
    public function setGoogleAnalyticsId($google_analytics_id)
    {
        $this->google_analytics_id = $google_analytics_id;
    }

    /**
     * @return string
     */
    public function getGoogleAnalyticsId()
    {
        return $this->google_analytics_id;
    }

    /**
     * @param boolean $is_ftp_site
     */
    public function setIsFtpSite($is_ftp_site)
    {
        $this->is_ftp_site = $is_ftp_site;
    }

    /**
     * @return boolean
     */
    public function getIsFtpSite()
    {
        return $this->is_ftp_site;
    }

    /**
     * @param boolean $is_readonly
     */
    public function setIsReadonly($is_readonly)
    {
        $this->is_readonly = $is_readonly;
    }

    /**
     * @return boolean
     */
    public function getIsReadonly()
    {
        return $this->is_readonly;
    }

    /**
     * @param int $message_id
     */
    public function setMessageId($message_id)
    {
        $this->message_id = $message_id;
    }

    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * @param string $multisite
     */
    public function setMultisite($multisite)
    {
        $this->multisite = $multisite;
    }

    /**
     * @return string
     */
    public function getMultisite()
    {
        return $this->multisite;
    }

    /**
     * @param string $multisite_network
     */
    public function setMultisiteNetwork($multisite_network)
    {
        $this->multisite_network = $multisite_network;
    }

    /**
     * @return string
     */
    public function getMultisiteNetwork()
    {
        return $this->multisite_network;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $notification_key
     */
    public function setNotificationKey($notification_key)
    {
        $this->notification_key = $notification_key;
    }

    /**
     * @return string
     */
    public function getNotificationKey()
    {
        return $this->notification_key;
    }

    /**
     * @param string $random_worker_key
     */
    public function setRandomWorkerKey($random_worker_key)
    {
        $this->random_worker_key = $random_worker_key;
    }

    /**
     * @return string
     */
    public function getRandomWorkerKey()
    {
        return $this->random_worker_key;
    }

    /**
     * @param boolean $secure_transfer
     */
    public function setSecureTransfer($secure_transfer)
    {
        $this->secure_transfer = $secure_transfer;
    }

    /**
     * @return boolean
     */
    public function getSecureTransfer()
    {
        return $this->secure_transfer;
    }

    /**
     * @param string $site_added
     */
    public function setSiteAdded($site_added)
    {
        $this->site_added = $site_added;
    }

    /**
     * @return string
     */
    public function getSiteAdded()
    {
        return $this->site_added;
    }

    /**
     * @param string $site_color
     */
    public function setSiteColor($site_color)
    {
        $this->site_color = $site_color;
    }

    /**
     * @return string
     */
    public function getSiteColor()
    {
        return $this->site_color;
    }

    /**
     * @param string $site_ip
     */
    public function setSiteIp($site_ip)
    {
        $this->site_ip = $site_ip;
    }

    /**
     * @return string
     */
    public function getSiteIp()
    {
        return $this->site_ip;
    }

    /**
     * @param string $site_key
     */
    public function setSiteKey($site_key)
    {
        $this->site_key = $site_key;
    }

    /**
     * @return string
     */
    public function getSiteKey()
    {
        return $this->site_key;
    }

    /**
     * @param string $table_optimization
     */
    public function setTableOptimization($table_optimization)
    {
        $this->table_optimization = $table_optimization;
    }

    /**
     * @return string
     */
    public function getTableOptimization()
    {
        return $this->table_optimization;
    }

    /**
     * @param string $worker_path
     */
    public function setWorkerPath($worker_path)
    {
        $this->worker_path = $worker_path;
    }

    /**
     * @return string
     */
    public function getWorkerPath()
    {
        return $this->worker_path;
    }

    /**
     * @param string $worker_version
     */
    public function setWorkerVersion($worker_version)
    {
        $this->worker_version = $worker_version;
    }

    /**
     * @return string
     */
    public function getWorkerVersion()
    {
        return $this->worker_version;
    }

    /**
     * @param string $wp_admin_url
     */
    public function setWpAdminUrl($wp_admin_url)
    {
        $this->wp_admin_url = $wp_admin_url;
    }

    /**
     * @return string
     */
    public function getWpAdminUrl()
    {
        return $this->wp_admin_url;
    }

    /**
     * @param string $wp_description
     */
    public function setWpDescription($wp_description)
    {
        $this->wp_description = $wp_description;
    }

    /**
     * @return string
     */
    public function getWpDescription()
    {
        return $this->wp_description;
    }

    /**
     * @param string $wp_password
     */
    public function setWpPassword($wp_password)
    {
        $this->wp_password = $wp_password;
    }

    /**
     * @return string
     */
    public function getWpPassword()
    {
        return $this->wp_password;
    }

    /**
     * @param string $wp_title
     */
    public function setWpTitle($wp_title)
    {
        $this->wp_title = $wp_title;
    }

    /**
     * @return string
     */
    public function getWpTitle()
    {
        return $this->wp_title;
    }

    /**
     * @param string $wp_url
     */
    public function setWpUrl($wp_url)
    {
        $this->wp_url = $wp_url;
    }

    /**
     * @return string
     */
    public function getWpUrl()
    {
        return $this->wp_url;
    }

    /**
     * @param string $wp_username
     */
    public function setWpUsername($wp_username)
    {
        $this->wp_username = $wp_username;
    }

    /**
     * @return string
     */
    public function getWpUsername()
    {
        return $this->wp_username;
    }

    /**
     * @param array $group_ids
     */
    public function setGroupIds(array $group_ids)
    {
        $this->group_ids = $group_ids;
    }

    /**
     * @return array
     */
    public function getGroupIds()
    {
        return $this->group_ids;
    }
}