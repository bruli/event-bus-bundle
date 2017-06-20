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

    /**
     * @test
     */
    public function itShouldHandleWithPreMiddleWare()
    {
        $this->app->setCommand(new WithPreMiddleWareCommand());

        $this->app->doRun($this->input, $this->outputInterface);

        $handlerFilename = __DIR__ . '/' . WithPreMiddleWareHandler::FILE_TEST;
        $preHandlerFilename = __DIR__.'/'. PreMiddleWareHandler::FILE_TEST;
        $this->assertTrue(file_exists($handlerFilename));
        $this->assertTrue(file_exists($preHandlerFilename));

        unlink($handlerFilename);
        unlink($preHandlerFilename);
    }

    /**
     * @test
     */
    public function itShouldHandleWithPostMiddleWare()
    {
        $this->app->setCommand(new WithPostMiddleWareCommand());

        $this->app->doRun($this->input, $this->outputInterface);

        $handlerFilename = __DIR__ . '/' . WithPostMiddleWareHandler::FILE_TEST;
        $postHandlerFilename = __DIR__.'/'. PostMiddleWareHandler::FILE_TEST;
        $this->assertTrue(file_exists($handlerFilename));
        $this->assertTrue(file_exists($postHandlerFilename));

        unlink($handlerFilename);
        unlink($postHandlerFilename);
    }
}
