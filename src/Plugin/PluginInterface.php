<?php

namespace ZF\Doctrine\Repository\Plugin;

use ZF\Doctrine\Repository\ObjectRepositoryInterface;

interface PluginInterface
{
    /**
     * $creationsOptions will have two keys
     *
     *   ZF\Doctrine\Repository\ObjectRepository 'repository'
     *   array $parameters
     *
     * These are defined in ZF\Doctrine\Repository\ObjectRepository::plugin
     */
    public function __construct(array $creationOptions);
}
