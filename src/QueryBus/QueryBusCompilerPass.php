<?php

namespace Bruli\EventBusBundle\QueryBus;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class QueryBusCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('bruli.query.bus')) {
            return;
        }

        $definition = $container->findDefinition('bruli.bus.options.resolver');
        $queryHandlers = $container->findTaggedServiceIds('bruli.query_handler');
        $preMiddleWares = $container->findTaggedServiceIds('bruli.query_pre_middleware');
        $postMiddleWares = $container->findTaggedServiceIds('bruli.query_post_middleware');

        foreach ($queryHandlers as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addOption', [$attributes['handles'], $id]);
            }
        }

        foreach ($preMiddleWares as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addPreMiddleWareOption', [$attributes['handles'], $id]);
            }
        }

        foreach ($postMiddleWares as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall('addPostMiddleWareOption', [$attributes['handles'], $id]);
            }
        }
    }
}
