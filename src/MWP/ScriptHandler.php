<?php

/**
 * Post-install/post-update composer script handler.
 */

namespace MWP;

use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use MWP\Compiler\SetPDOConfigurationPass;

class ScriptHandler
{

    public static function buildContainer()
    {
        $debug = true;
        $containerFile = __DIR__ . '/../../container.php';
        $containerConfigCache = new ConfigCache($containerFile, $debug);

        if (!$containerConfigCache->isFresh()) {
            $containerBuilder = new ContainerBuilder();

            $PDOConfiguratorPass = self::getPDOConfiguratorPass();
            $containerBuilder->addCompilerPass($PDOConfiguratorPass);

            $loader = new XmlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/../../config'));
            $loader->load('services.xml');
            $containerBuilder->compile();

            $dumper = new PhpDumper($containerBuilder);
            $containerConfigCache->write(
                $dumper->dump(array('class' => 'MWPContainer')),
                $containerBuilder->getResources()
            );
        }
    }

    protected static function getPDOConfiguratorPass()
    {
        $dbHost = getenv('MWP_PDO_DB_HOST');
        $dbPort = getenv('MWP_PDO_DB_PORT');
        $dbName = getenv('MWP_PDO_DB_NAME');
        $dbUser = getenv('MWP_PDO_DB_USER');
        $dbPassword = getenv('MWP_PDO_DB_PASSWORD');
        $dbTablePrefix = getenv('MWP_PDO_DB_TABLE_PREFIX');

        $pdoConfigurator = new SetPDOConfigurationPass($dbName, $dbUser, $dbPassword, $dbHost, $dbPort, $dbTablePrefix);
        return $pdoConfigurator;
    }
}