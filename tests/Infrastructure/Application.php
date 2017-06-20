<?php


namespace Bruli\EventBusBundleTests\Infrastructure;

use Bruli\EventBusBundle\CommandBus\CommandInterface;
use Bruli\EventBusBundleTests\Behaviour\SingleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Application extends \Symfony\Component\Console\Application
{
    /**
     * @var AppKernel
     */
    private $container;
    /**
     * @var CommandInterface
     */
    private $command;

    public function __construct()
    {
        $appKernel = new AppKernel('dev', true);
        $appKernel->boot();
        $this->container = $appKernel->getContainer();

        parent::__construct('command test');
    }

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