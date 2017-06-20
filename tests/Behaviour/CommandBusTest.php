<?php

namespace Bruli\EventBusBundleTests\Behaviour;

use Bruli\EventBusBundleTests\Infrastructure\Application;
use Bruli\EventBusBundleTests\Behaviour\SingleCommand;
use Bruli\EventBusBundleTests\Behaviour\SingleCommandHandler;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandBusTest extends TestCase
{
    /**
     * @var Application
     */
    private $app;
    /**
     * @var InputInterface
     */
    private $input;
    /**
     * @var OutputInterface
     */
    private $outputInterface;

    protected function setUp()
    {
        $this->app =  new Application();
        $this->input = \Mockery::mock(InputInterface::class);
        $this->outputInterface = \Mockery::mock(OutputInterface::class);
    }

    /**
     * @test
     */
    public function itShouldHandleSingleHandler()
    {
        $this->app->setCommand(new SingleCommand());

        $this->app->doRun($this->input, $this->outputInterface);

        $filename = __DIR__ . '/' . SingleCommandHandler::FILE_TEST;
        $this->assertTrue(file_exists($filename));

        unlink($filename);
    }
}