<?php

namespace Bruli\EventBusBundle\CommandBus;

use Bruli\EventBusBundle\BusOptionsResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CommandBus
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var BusOptionsResolver
     */
    private $optionsResolver;

    /**
     * CommandBus constructor.
     *
     * @param ContainerInterface $container
     * @param BusOptionsResolver $optionsResolver
     */
    public function __construct(ContainerInterface $container, BusOptionsResolver $optionsResolver)
    {
        $this->container = $container;
        $this->optionsResolver = $optionsResolver;
    }

    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        $this->handlePreMiddleWares($command);
        $this->handleCommand($command);
        $this->handlePostMiddleWares($command);
    }

    /**
     * @param CommandInterface $command
     */
    private function handlePreMiddleWares(CommandInterface $command)
    {
        if (true === $this->optionsResolver->preMiddleWareHasCommand(get_class($command))) {
            $this->container->get($this->optionsResolver->getPreMiddleWareOption('\\' . get_class($command)))->handle(
                $command
            );
        }
    }

    /**
     * @param CommandInterface $command
     */
    private function handleCommand(CommandInterface $command)
    {
        $this->container->get($this->optionsResolver->getOption('\\' . get_class($command)))->handle($command);
    }

    /**
     * @param CommandInterface $command
     */
    private function handlePostMiddleWares(CommandInterface $command)
    {
        if (true === $this->optionsResolver->postMiddleWareHasCommand(get_class($command))) {
            $this->container->get($this->optionsResolver->getPostMiddleWareOption('\\' . get_class($command)))->handle(
                $command
            );
        }
    }
}
