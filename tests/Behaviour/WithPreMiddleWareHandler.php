<?php

declare(strict_types=1);


namespace Bruli\EventBusBundleTests\Behaviour;


use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;

final class WithPreMiddleWareHandler implements CommandHandlerInterface
{
    const FILE_TEST = 'with_pre_middleware.txt';

    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        file_put_contents(__DIR__. '/' . self::FILE_TEST , 'testing');
        unlink(__DIR__. '/'. PreMiddleWareHandler::FILE_TEST);
        unlink(__DIR__. '/'. PreSecondMiddleWareHandler::FILE_TEST);
    }
}
