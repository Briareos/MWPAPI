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
use MWP\Compiler\LoadConfigurationPass;
use Composer\Script\CommandEvent;

class ScriptHandler
{
    public static function getConfigDir()
    {
        return __DIR__ . '/../../config';
    }

    public static function buildContainer(CommandEvent $event)
    {
        $event->getIO()->write('Updating database credentials');

        $debug = true;
        $containerFile = __DIR__ . '/../../container.php';
        $containerConfigCache = new ConfigCache($containerFile, $debug);

        if (!$containerConfigCache->isFresh()) {
            $containerBuilder = new ContainerBuilder();

            $configuratorPass = self::getLoadConfigurationPass();
            $containerBuilder->addCompilerPass($configuratorPass);

            $loader = new XmlFileLoader($containerBuilder, new FileLocator(self::getConfigDir()));
            $loader->load('services.xml');
            $containerBuilder->compile();

            $dumper = new PhpDumper($containerBuilder);
            $containerConfigCache->write(
                $dumper->dump(array('class' => 'MWPContainer')),
                $containerBuilder->getResources()
            );
        }
    }

    protected static function getLoadConfigurationPass()
    {
        $configFile = self::getConfigDir() . '/config.php';
        if (!file_exists($configFile)) {
            throw new \Exception(sprintf('File config.php does not exist on path %s', realpath($configFile)));
        }
        $config = require_once $configFile;

        $configurator = new LoadConfigurationPass($config);
        return $configurator;
    }
}