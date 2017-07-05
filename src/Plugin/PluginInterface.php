<?php

namespace ZF\Doctrine\Repository\Plugin;

use ZF\Doctrine\Repository\ObjectRepositoryInterface;

interface PluginInterface
{
    public function __construct(array $creationOptions);
}
