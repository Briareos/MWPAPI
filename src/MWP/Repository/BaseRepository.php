<?php

namespace MWP\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

abstract class BaseRepository
{
    protected $db;

    protected $prefix = '';

    function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    protected function createQueryBuilder()
    {
        return $this->db->createQueryBuilder();
    }

    /**
     * @return string
     */
    abstract public function getEntityClass();
}