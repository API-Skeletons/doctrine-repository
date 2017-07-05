<?php

namespace ZF\Doctrine\Repository;

interface ObjectRepositoryInterface
{
    public function setPluginManager(PluginManager $pluginManager);
    public function plugin($name);
}