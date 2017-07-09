<?php

namespace ZFTest\Doctrine\Repository;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'doctrine' => [
        'driver' => [
            'orm_driver' => [
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\XmlDriver',
                'paths' => [
                    0 => __DIR__ . '/orm',
                ],
            ],
            'orm_default' => [
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\DriverChain',
                'drivers' => [
                    'ZFTest\\Doctrine\\Repository\\Entity' => 'orm_driver',
                ],
            ],
        ],
    ],
    'zf-doctrine-repository-plugin' => [
        'aliases' => [
            'boolean' => Plugin\BooleanPlugin::class,
        ],
        'factories' => [
            Plugin\BooleanPlugin::class => InvokableFactory::class,
        ]
    ],
];
