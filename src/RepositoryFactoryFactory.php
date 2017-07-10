<?php

namespace ZF\Doctrine\Repository;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use GianArb\Angry\Unclonable;
use GianArb\Angry\Unserializable;

class RepositoryFactoryFactory implements
    FactoryInterface
{
    use Unclonable;
    use Unserializable;

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $instance = new RepositoryFactory();
        $instance->setPluginManager($container->get(Plugin\PluginManager::class));

        return $instance;
    }
}
