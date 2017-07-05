<?php

return [
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'repository_factory' => 'ZF\Doctrine\Repository\RepositoryFactory',
            ], 
        ],
    ],
    'service_manager' => [
        'factories' => [
            'ZF\Doctrine\Repository\RepositoryFactory' =>
                'ZF\Doctrine\Repository\RepositoryFactoryFactory',
        ],
    ],
];
