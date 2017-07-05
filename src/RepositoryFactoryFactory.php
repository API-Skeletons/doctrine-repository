<?php

namespace ZF\Doctrine\Repository;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class RepositoryFactoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $instance = new RepositoryFactory();
        $instance->setPluginManager($container->get(Plugin\PluginManager::class));

        return $instance;
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, null);
    }
}
