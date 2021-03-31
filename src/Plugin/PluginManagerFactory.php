<?php

namespace ApiSkeletons\Doctrine\Repository\Plugin;

use Laminas\Mvc\Service\AbstractPluginManagerFactory;
use GianArb\Angry\Unclonable;
use GianArb\Angry\Unserializable;

class PluginManagerFactory extends AbstractPluginManagerFactory
{
    use Unclonable;
    use Unserializable;

    const PLUGIN_MANAGER_CLASS = PluginManager::class;
}
