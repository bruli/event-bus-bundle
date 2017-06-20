<?php

namespace Bruli\EventBusBundle\CommandBus;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CommandBusCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('bruli.command.bus')) {
            return;
        }

        $definition = $container->findDefinition('bruli.bus.options.resolver');
        $commandHandlers = $container->findTaggedServiceIds('bruli.command_handler');
        $preMiddleWares = $container->findTaggedServiceIds('bruli.command_pre_middleware');
        $postMiddleWares = $container->findTaggedServiceIds('bruli.command_post_middleware');

        foreach ($commandHandlers as $id => $tags) {
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
