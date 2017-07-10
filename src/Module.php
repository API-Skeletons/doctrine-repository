<?php

namespace ZF\Doctrine\Repository;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use GianArb\Angry\Unclonable;
use GianArb\Angry\Unserializable;

class Module implements
    ConfigProviderInterface,
    InitProviderInterface,
    DependencyIndicatorInterface
{
    use Unclonable;
    use Unserializable;

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function init(ModuleManagerInterface $moduleManager)
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
