<?php

namespace MWP\Repository;

use Doctrine\DBAL\Connection;

abstract class BaseRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    /**
     * @var string
     */
    protected $prefix = '';

    /**
     * @param \Doctrine\DBAL\Connection $connection
     */
    function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    protected function createQueryBuilder()
    {
        return $this->db->createQueryBuilder();
    }

    /**
     * @return string
     */
    abstract public function getEntityClass();
}