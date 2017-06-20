<?php

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;

/**
 * InfrastructureDevDebugProjectContainer.
 *
 * This class has been auto-generated
 * by the Symfony Dependency Injection Component.
 */
class InfrastructureDevDebugProjectContainer extends Container
{
    private $parameters;
    private $targetDirs = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $dir = __DIR__;
        for ($i = 1; $i <= 5; ++$i) {
            $this->targetDirs[$i] = $dir = dirname($dir);
        }
        $this->parameters = $this->getDefaultParameters();

        $this->services = array();
        $this->methodMap = array(
            'bruli.bus.options.resolver' => 'getBruli_Bus_Options_ResolverService',
            'bruli.command.bus' => 'getBruli_Command_BusService',
            'bruli.query.bus' => 'getBruli_Query_BusService',
            'single.command.handler' => 'getSingle_Command_HandlerService',
        );

        $this->aliases = array();
    }

    /**
     * {@inheritdoc}
     */
    public function compile()
    {
        throw new LogicException('You cannot compile a dumped frozen container.');
    }

    /**
     * {@inheritdoc}
     */
    public function isFrozen()
    {
        return true;
    }

    /**
     * Gets the 'bruli.bus.options.resolver' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Bruli\EventBusBundle\BusOptionsResolver A Bruli\EventBusBundle\BusOptionsResolver instance
     */
    protected function getBruli_Bus_Options_ResolverService()
    {
        $this->services['bruli.bus.options.resolver'] = $instance = new \Bruli\EventBusBundle\BusOptionsResolver();

        $instance->addOption('\\Bruli\\EventBusBundleTests\\Behaviour\\SingleCommand', 'single.command.handler');

        return $instance;
    }

    /**
     * Gets the 'bruli.command.bus' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Bruli\EventBusBundle\CommandBus\CommandBus A Bruli\EventBusBundle\CommandBus\CommandBus instance
     */
    protected function getBruli_Command_BusService()
    {
        return $this->services['bruli.command.bus'] = new \Bruli\EventBusBundle\CommandBus\CommandBus($this, $this->get('bruli.bus.options.resolver'));
    }

    /**
     * Gets the 'bruli.query.bus' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Bruli\EventBusBundle\QueryBus\QueryBus A Bruli\EventBusBundle\QueryBus\QueryBus instance
     */
    protected function getBruli_Query_BusService()
    {
        return $this->services['bruli.query.bus'] = new \Bruli\EventBusBundle\QueryBus\QueryBus($this, $this->get('bruli.bus.options.resolver'));
    }

    /**
     * Gets the 'single.command.handler' service.
     *
     * This service is shared.
     * This method always returns the same instance of the service.
     *
     * @return \Bruli\EventBusBundleTests\Behaviour\SingleCommandHandler A Bruli\EventBusBundleTests\Infrastructure\SingleCommandHandler instance
     */
    protected function getSingle_Command_HandlerService()
    {
        return $this->services['single.command.handler'] = new \Bruli\EventBusBundleTests\Behaviour\SingleCommandHandler();
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        $name = strtolower($name);

        if (!(isset($this->parameters[$name]) || array_key_exists($name, $this->parameters) || isset($this->loadedDynamicParameters[$name]))) {
            throw new InvalidArgumentException(sprintf('The parameter "%s" must be defined.', $name));
        }
        if (isset($this->loadedDynamicParameters[$name])) {
            return $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        }

        return $this->parameters[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter($name)
    {
        $name = strtolower($name);

        return isset($this->parameters[$name]) || array_key_exists($name, $this->parameters) || isset($this->loadedDynamicParameters[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        throw new LogicException('Impossible to call set() on a frozen ParameterBag.');
    }

    /**
     * {@inheritdoc}
     */
    public function getParameterBag()
    {
        if (null === $this->parameterBag) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = array(
        'kernel.root_dir' => false,
        'kernel.logs_dir' => false,
        'kernel.bundles_metadata' => false,
    );
    private $dynamicParameters = array();

    /**
     * Computes a dynamic parameter.
     *
     * @param string The name of the dynamic parameter to load
     *
     * @return mixed The value of the dynamic parameter
     *
     * @throws InvalidArgumentException When the dynamic parameter does not exist
     */
    private function getDynamicParameter($name)
    {
        switch ($name) {
            case 'kernel.root_dir': $value = $this->targetDirs[2]; break;
            case 'kernel.logs_dir': $value = ($this->targetDirs[2].'/logs'); break;
            case 'kernel.bundles_metadata': $value = array(
                'EventBusBundle' => array(
                    'parent' => NULL,
                    'path' => ($this->targetDirs[4].'/src'),
                    'namespace' => 'Bruli\\EventBusBundle',
                ),
            ); break;
            default: throw new InvalidArgumentException(sprintf('The dynamic parameter "%s" must be defined.', $name));
        }
        $this->loadedDynamicParameters[$name] = true;

        return $this->dynamicParameters[$name] = $value;
    }

    /**
     * Gets the default parameters.
     *
     * @return array An array of the default parameters
     */
    protected function getDefaultParameters()
    {
        return array(
            'kernel.environment' => 'dev',
            'kernel.debug' => true,
            'kernel.name' => 'Infrastructure',
            'kernel.cache_dir' => __DIR__,
            'kernel.bundles' => array(
                'EventBusBundle' => 'Bruli\\EventBusBundle\\EventBusBundle',
            ),
            'kernel.charset' => 'UTF-8',
            'kernel.container_class' => 'InfrastructureDevDebugProjectContainer',
        );
    }
}
