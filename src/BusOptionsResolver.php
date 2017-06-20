<?php

namespace Bruli\EventBusBundle;

class BusOptionsResolver
{
    /**
     * @var array
     */
    private $option = [];
    /**
     * @var array
     */
    private $preMiddleWareOption = [];
    /**
     * @var array
     */
    private $postMiddleWareOption = [];


    /**
     * @param string $command
     * @param string $handler
     */
    public function addOption($command, $handler)
    {
        $this->option[$command] = $handler;
    }

    /**
     * @param string $command
     * @param string $handler
     */
    public function addPreMiddleWareOption($command, $handler)
    {
        $this->preMiddleWareOption[$command] = $handler;
    }

    /**
     * @param string $command
     * @param string $handler
     */
    public function addPostMiddleWareOption($command, $handler)
    {
        $this->preMiddleWareOption[$command] = $handler;
    }

    /**
     * @param string $command
     *
     * @return string
     */
    public function getOption($command)
    {
        return $this->option[$command];
    }

    /**
     * @param string $command
     * @return string
     */
    public function getPreMiddleWareOption($command)
    {
        return $this->preMiddleWareOption[$command];
    }

    /**
     * @param string $command
     * @return bool
     */
    public function preMiddleWareHasCommand($command)
    {
        return array_key_exists($command, $this->preMiddleWareOption);
    }

    /**
     * @param string $command
     * @return bool
     */
    public function postMiddleWareHasCommand($command)
    {
        return array_key_exists($command, $this->preMiddleWareOption);
    }

    /**
     * @param string $command
     * @return string
     */
    public function getPostMiddleWareOption($command)
    {
        return $this->postMiddleWareOption[$command];
    }
}
