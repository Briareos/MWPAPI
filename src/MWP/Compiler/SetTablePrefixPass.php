<?php

namespace MWP\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SetTablePrefixPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $repositoryManagerDefinition = $container->getDefinition('repository_manager');
        $repositories = $container->findTaggedServiceIds('mwp.repository');
        $prefix = $container->getParameter('db_table_prefix');
        foreach ($repositories as $serviceId => $tags) {
            foreach ($tags as $tag) {
                $repositoryManagerDefinition->addMethodCall(
                    'registerRepository',
                    array($tag['alias'], new Reference($serviceId))
                );
                $definition = $container->getDefinition($serviceId);
                $definition->addMethodCall('setPrefix', array($prefix));
            }
        }
    }

}