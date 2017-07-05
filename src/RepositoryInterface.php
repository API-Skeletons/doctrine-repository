<?php

namespace ZF\Doctrine\Repository;

interface RepositoryInterface
{
    public function setPluginManager(PluginManager $pluginManager);
    public function plugin($name);
}