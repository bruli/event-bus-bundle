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

        $queryBus = $container->findDefinition('bruli.bus.options.resolver');
        $queryHandlers = $container->findTaggedServiceIds('bruli.query_handler');

        foreach ($queryHandlers as $id => $tags) {
            foreach ($tags as $attributes) {
                $queryBus->addMethodCall('addOption', [$attributes['handles'], $id]);
            }
        }
    }
}
