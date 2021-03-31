<?php

namespace ApiSkeletons\Doctrine\Repository;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\InitProviderInterface;
use Laminas\ModuleManager\Feature\DependencyIndicatorInterface;
use Laminas\ModuleManager\ModuleManagerInterface;
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
            'api-skeletons-doctrine-repository-plugin',
            Plugin\PluginInterface::class,
            'getZFDoctrineRepositoryPluginManagerConfig'
        );
    }

    public function getModuleDependencies()
    {
        return ['DoctrineORMModule'];
    }
}
