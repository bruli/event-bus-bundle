<?php


namespace Bruli\EventBusBundleTests\Infrastructure;

use Bruli\EventBusBundle\CommandBus\CommandInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CommandApplication extends Application
{
    /**
     * @var CommandInterface
     */
    private $command;
    /**
     * @param CommandInterface $command
     */
    public function setCommand(CommandInterface $command)
    {
        $this->command = $command;
    }

    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $command = $this->container->get('bruli.command.bus');

        $command->handle($this->command);
    }

}