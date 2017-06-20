<?php

declare(strict_types=1);


namespace Bruli\EventBusBundleTests\Infrastructure;


abstract class Application extends \Symfony\Component\Console\Application
{
    /**
     * @var AppKernel
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