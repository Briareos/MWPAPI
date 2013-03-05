<?php

namespace MWP\Repository;

class RepositoryManager
{
    /**
     * @var BaseRepository[]
     */
    protected $repositories;

    public function registerRepository($name, BaseRepository $repository)
    {
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