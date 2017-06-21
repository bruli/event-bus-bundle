<?php

declare(strict_types=1);


namespace Bruli\EventBusBundleTests\Behaviour;


use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;

final class PostSecondMiddleWareHandler implements CommandHandlerInterface
{
    const FILE_TEST = 'post-second-middleware.txt';

    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        file_put_contents(__DIR__. '/' . self::FILE_TEST , 'testing');
        unlink(__DIR__. '/' . WithPostMiddleWareHandler::FILE_SECOND_TEST);
    }
}
