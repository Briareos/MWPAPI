<?php

/**
 * Post-install/post-update composer script handler.
 */

namespace MWP;

use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use MWP\Compiler\LoadConfigurationPass;
use MWP\Compiler\SetTablePrefixPass;
use Composer\Script\CommandEvent;

class ScriptHandler
{
    public static function getConfigDir()
    {
        return __DIR__ . '/../../config';
    }

    public static function getContainerDir()
    {
        return __DIR__ . '/../../cache';
    }

    public static function refreshContainer()
    {
        $debug = true;
        $containerFile = self::getContainerDir() . '/container.php';
        $containerConfigCache = new ConfigCache($containerFile, $debug);

        if (!$containerConfigCache->isFresh()) {
            self::compileContainer($containerConfigCache);
        }
    }

    public static function buildContainer(CommandEvent $event)
    {
        self::refreshContainer();
    }

    public static function compileContainer(ConfigCache $containerConfigCache)
    {
        $containerBuilder = new ContainerBuilder();
        $configFile = self::getConfigDir() . '/config.php';
        if (!file_exists($configFile)) {
            throw new \Exception(sprintf('File config.php does not exist on path %s', realpath($configFile)));
        }
        $config = require_once $configFile;

        $containerBuilder->addCompilerPass(new LoadConfigurationPass($config));
        $containerBuilder->addCompilerPass(new SetTablePrefixPass());

        // Add the config file as resource, because the cache is not fresh if we modify it.
        $configResource = new FileResource($configFile);
        $containerBuilder->addResource($configResource);

        $loader = new XmlFileLoader($containerBuilder, new FileLocator(self::getConfigDir()));
        $loader->load('services.xml');
        $containerBuilder->compile();

        $dumper = new PhpDumper($containerBuilder);
        $containerConfigCache->write(
            $dumper->dump(
                array(
                    'class' => 'MWPContainer',
                    'base_class' => '\MWP\Container',
                )
            ),
            $containerBuilder->getResources()
        );
    }
}