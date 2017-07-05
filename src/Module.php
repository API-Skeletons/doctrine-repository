<?php

namespace ZF\Doctrine\Repository;

use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

class Module implements
    ConfigProviderInterface,
    InitProviderInterface,
    DependencyIndicatorInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function init(ModuleManager $moduleManager)
    {
        $serviceManager = $moduleManager->getEvent()->getParam('ServiceManager');
        $serviceListener = $serviceManager->get('ServiceListener');

        $serviceListener->addServiceManager(
            Plugin\PluginManager::class,
            'zf-doctrine-repository-plugin',
            Plugin\PluginInterface::class,
            'getZFDoctrineRepositoryPluginManagerConfig'
        );
    }

    public function getModuleDependencies()
    {
        return ['DoctrineORMModule'];
    }
}
