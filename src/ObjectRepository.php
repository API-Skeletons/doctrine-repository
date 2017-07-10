<?php

namespace ZF\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use GianArb\Angry\Unclonable;
use GianArb\Angry\Unserializable;

class ObjectRepository extends EntityRepository implements
    ObjectRepositoryInterface
{
    use Unclonable;
    use Unserializable;

    protected $pluginManager;

    public function setPluginManager(Plugin\PluginManager $pluginManager)
    {
        $this->pluginManager = $pluginManager;

        return $this;
    }

    /**
     * Returns Plugin\PluginInterface
     */
    public function plugin($name, array $parameters = null)
    {
        return $this->pluginManager->get($name, ['repository' => $this, 'parameters' => $parameters]);
    }
}
