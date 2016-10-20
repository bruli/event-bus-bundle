<?php

namespace Bruli\EventBusBundle\CommandBus;

interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command);
}
