<?php

namespace ApiSkeletons\Doctrine\Repository\Plugin;

use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception;
use Interop\Container\ContainerInterface;
use GianArb\Angry\Unclonable;
use GianArb\Angry\Unserializable;

class PluginManager extends AbstractPluginManager
{
    use Unclonable;
    use Unserializable;

    private $container;

    /**
     * @var string
     */
    protected $instanceOf = PluginInterface::class;

    /**
     * Validate the plugin is of the expected type (v3).
     *
     * Validates against `$instanceOf`.
     *
     * @param mixed $instance
     * @throws Exception\InvalidServiceException
     */
    public function validate($instance)
    {
        if (! $instance instanceof $this->instanceOf) {
            throw new Exception\InvalidServiceException(sprintf(
                '%s can only create instances of %s; %s is invalid',
                get_class($this),
                $this->instanceOf,
                is_object($instance) ? get_class($instance) : gettype($instance)
            ));
        }
    }

    /**
     * Validate the plugin is of the expected type (v2).
     *
     * Proxies to `validate()`.
     *
     * @param mixed $plugin
     * @return void
     * @throws Exception\InvalidArgumentException
     */
    public function validatePlugin($plugin)
    {
        try {
            $this->validate($plugin);
        } catch (Exception\InvalidServiceException $e) {
            throw new Exception\InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
