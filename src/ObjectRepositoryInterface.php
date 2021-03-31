<?php

namespace ApiSkeletons\Doctrine\Repository;

interface ObjectRepositoryInterface
{
    public function setPluginManager(Plugin\PluginManager $pluginManager);
    public function plugin($name);
    public function getObjectManager();
}
