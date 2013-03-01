<?php

namespace MWP\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SetPDOConfigurationPass implements CompilerPassInterface
{
    protected $dbHost;

    protected $dbPort;

    protected $dbName;

    protected $dbUser;

    protected $dbPassword;

    protected $dbTablePrefix;

    function __construct(
        $dbName,
        $dbUser = 'root',
        $dbPassword = '',
        $dbHost = 'localhost',
        $dbPort = 3306,
        $dbTablePrefix = ''
    ) {
        $this->dbHost = $dbHost;
        $this->dbPort = $dbPort;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        $this->dbTablePrefix = $dbTablePrefix;
    }


    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $container->setParameter('mwp.db_host', $this->dbHost);
        $container->setParameter('mwp.db_name', $this->dbName);
        $container->setParameter('mwp.db_user', $this->dbUser);
        $container->setParameter('mwp.db_password', $this->dbPassword);
        $container->setParameter('mwp.db_table_prefix', $this->dbTablePrefix);
    }

}