<?php

namespace MWP\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LoadConfigurationPass implements CompilerPassInterface
{
    protected $dbHost;

    protected $dbPort;

    protected $dbName;

    protected $dbUser;

    protected $dbPassword;

    protected $dbTablePrefix;

    function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        foreach ($this->config as $configName => $configValue) {
            $container->setParameter($configName, $configValue);
        }
    }


}