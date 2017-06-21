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
    private $preMiddleWareOptions = [];
    /**
     * @var array
     */
    private $postMiddleWareOptions = [];


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
    public function addPreMiddleWareOptions($command, $handler)
    {
        $this->preMiddleWareOptions[$command][] = $handler;
    }

    /**
     * @param string $command
     * @param string $handler
     */
    public function addPostMiddleWareOptions($command, $handler)
    {
        $this->postMiddleWareOptions[$command][] = $handler;
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
     * @return array
     */
    public function getPreMiddleWareOptions($command)
    {
        return $this->preMiddleWareOptions[$command];
    }

    /**
     * @param string $command
     * @return bool
     */
    public function preMiddleWareHasCommands($command)
    {
        return array_key_exists($command, $this->preMiddleWareOptions);
    }

    /**
     * @param string $command
     * @return bool
     */
    public function postMiddleWareHasCommands($command)
    {
        return array_key_exists($command, $this->postMiddleWareOptions);
    }

    /**
     * @param string $command
     * @return array
     */
    public function getPostMiddleWareOptions($command)
    {
        return $this->postMiddleWareOptions[$command];
    }
}
