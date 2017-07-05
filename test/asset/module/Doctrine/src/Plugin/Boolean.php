<?php

namespace ZFTest\Doctrine\Repository\Plugin;

use ZF\Doctrine\Repository\Plugin\PluginInterface;

class Boolean implements PluginInterface
{
    protected $repository;
    protected $parameters;

    public function __construct(array $creationOptions)
    {
        $this->repository = $creationOptions['repository'];
        $this->parameters = $creationOptions['parameters'];
    }

    public function getEntityName()
    {
        return $this->repository->getEntityClass();
    }

    public function getBoolean($bool)
    {
        return $bool;
    }
}