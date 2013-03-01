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
use Composer\Script\CommandEvent;

class ScriptHandler
{

    public static function buildContainer(CommandEvent $event)
    {
        $event->getIO()->write('Updating database credentials');
        ob_start();
        phpinfo();
        file_put_contents('/home/fox/test.txt',ob_get_clean());

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
        $dbHost = getenv('MWP_DB_HOST');
        $dbPort = getenv('MWP_DB_PORT');
        $dbName = getenv('MWP_DB_NAME');
        $dbUser = getenv('MWP_DB_USER');
        $dbPassword = getenv('MWP_DB_PASSWORD');
        $dbTablePrefix = getenv('MWP_DB_TABLE_PREFIX');

        if(empty($dbHost)){
            throw new \Exception('Database host must be defined');
        }
        if(empty($dbPort)) {
            throw new \Exception('Database port must be defined');
        }
        if(empty($dbName)) {
            throw new \Exception('Database name must be defined');
        }
        if(empty($dbUser)) {
            throw new \Exception('Database user must be defined');
        }
        if(empty($dbPassword)) {
            throw new \Exception('Database password must be defined');
        }


        $pdoConfigurator = new SetPDOConfigurationPass($dbName, $dbUser, $dbPassword, $dbHost, $dbPort, $dbTablePrefix);
        return $pdoConfigurator;
    }
}