<?php

namespace ZF\Doctrine\Repository;

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'repository_factory' => RepositoryFactory::class,
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
