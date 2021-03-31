<?php

namespace ApiSkeletons\Doctrine\Repository\Plugin;

use ApiSkeletons\Doctrine\Repository\ObjectRepositoryInterface;

interface PluginInterface
{
    /**
     * $creationsOptions will have two keys
     *
     *   ApiSkeletons\Doctrine\Repository\ObjectRepository 'repository'
     *   array $parameters
     *
     * These are defined in ZF\Doctrine\Repository\ObjectRepository::plugin
     */
    public function __construct(array $creationOptions);
}
