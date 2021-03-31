<?php

namespace ApiSkeletons\Doctrine\Repository;

use GianArb\Angry\Unclonable;
use GianArb\Angry\Unserializable;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class RepositoryFactoryFactory implements
    FactoryInterface
{
    use Unclonable;
    use Unserializable;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $instance = new $requestedName();
        $instance->setPluginManager($container->get(Plugin\PluginManager::class));

        return $instance;
    }

    public function createService(ServiceLocatorInterface $services)
    {
        return $this($services, RepositoryFactory::class);
    }
}
