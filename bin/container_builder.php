<?php

use Symfony\Component\Config\ConfigCache;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;

require_once __DIR__ . '/../vendor/autoload.php';

function rebuild_container()
{
    $debug = true;
    $file = __DIR__ . '/../container.php';
    $containerConfigCache = new ConfigCache($file, $debug);

    if (!$containerConfigCache->isFresh()) {
        $containerBuilder = new ContainerBuilder();
        $loader = new XmlFileLoader($containerBuilder, new FileLocator(__DIR__));
        $loader->load(__DIR__ . '/../config/services.xml');
        $containerBuilder->compile();

        $dumper = new PhpDumper($containerBuilder);
        $containerConfigCache->write(
            $dumper->dump(array('class' => 'MWPContainer')),
            $containerBuilder->getResources()
        );
    }
}
