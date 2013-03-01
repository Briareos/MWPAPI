<?php

namespace MWP\Repository;

class RepositoryManager
{
    /**
     * @var BaseRepository[]
     */
    protected $repositories;

    protected $prefix;

    function __construct($prefix = '')
    {
        $this->prefix = $prefix;
    }


    public function registerRepository($name, BaseRepository $repository)
    {
        $repository->setPrefix($this->prefix);
        $this->repositories[$name] = $repository;
    }

    public function getRepository($name)
    {
        if (!isset($this->repositories[$name])) {
            throw new \Exception(sprintf('Repository "%s" is not registered.'));
        }
        return $this->repositories[$name];
    }
}