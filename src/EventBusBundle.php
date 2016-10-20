<?php

namespace Bruli\EventBusBundle;

use Bruli\EventBusBundle\CommandBus\CommandBusCompilerPass;
use Bruli\EventBusBundle\DependencyInjection\EventBusExtension;
use Bruli\EventBusBundle\QueryBus\QueryBusCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EventBusBundle extends Bundle
{
    /**
     * @return EventBusExtension
     */
    public function getContainerExtension()
    {
        return new EventBusExtension();
    }

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandBusCompilerPass());
        $container->addCompilerPass(new QueryBusCompilerPass());
    }
}
