<?php

namespace ZF\Doctrine\Repository;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RepositoryFactoryFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $instance = new RepositoryFactory();
        $instance->setPluginManager($serviceLocator->get('ZF\Doctrine\Repository\PluginManager'));

        return $instance;
    }
}