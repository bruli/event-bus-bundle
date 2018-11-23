<?php

declare(strict_types=1);


namespace Bruli\EventBusBundleTests\Infrastructure;

use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class Application extends \Symfony\Component\Console\Application
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct()
    {
        $appKernel = new AppKernel('dev', true);
        $appKernel->boot();
        $this->container = $appKernel->getContainer();

        parent::__construct('command test');
    }

}