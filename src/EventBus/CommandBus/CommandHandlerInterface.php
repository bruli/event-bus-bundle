<?php

namespace EventBus\CommandBus;

interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command);
}
