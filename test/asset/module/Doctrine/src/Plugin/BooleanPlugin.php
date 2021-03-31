<?php

namespace ApiSkeletonsTest\Doctrine\Repository\Plugin;

use ApiSkeletons\Doctrine\Repository\Plugin\PluginInterface;

class BooleanPlugin implements PluginInterface
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
        return $this->repository->getClassName();
    }

    public function getBoolean($bool)
    {
        return $bool;
    }
}
