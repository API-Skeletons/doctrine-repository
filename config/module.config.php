<?php

namespace ZF\Doctrine\Repository;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'repository_factory' => RepositoryFactory::class,
                'default_repository_class_name' => ObjectRepository::class,
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            RepositoryFactory::class =>
                RepositoryFactoryFactory::class,
            Plugin\PluginManager::class
                => Plugin\PluginManagerFactory::class,
        ],
    ],
    'zf-doctrine-repository-plugin' => [
    ],
];
