<?php

namespace Objectivehtml\Backup\Git;

use Gitonomy\Git\Repository;
use Illuminate\Config\Repository as ConfigRepository;

class Config {

    /**
     * @var array|null
     */
    protected $config;

    /**
     * @var \Gitonomy\Git\Repository
     */
    protected $repository;

    /**
     * Constructor
     * 
     * @param \Gitonomy\Git\Repository  $repository
     * @param array|null  $config
     */
    public function __construct(Repository $repository, ?array $config = [])
    {
        $this->repository = $repository;
        $this->config = new ConfigRepository($config ?: []);
    }

    /**
     * Get a list of remotes
     * 
     * @param \Gitonomy\Git\Repository  $repository
     * @param array|null  $config
     */
    public function getRemotes()
    {
        return $this->repository->run('ls-remote');
    }
}