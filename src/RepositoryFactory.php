<?php

namespace ZF\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory as ORMRepositoryFactory;

/**
 * This factory is used to create repository objects for entities at runtime.
 *
 * @author Tom H Anderson <tom.h.anderson@gmail.com>
 * for api-skeletons/zf-doctrine-repository based on
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @since 2.4
 */
final class RepositoryFactory implements
    ORMRepositoryFactory
{
    /**
     * The list of EntityRepository instances.
     *
     * @var \Doctrine\Common\Persistence\ObjectRepository[]
     */
    private $repositoryList = array();
    private $pluginManager;

    public function setPluginManager(PluginManager $pluginManager)
    {
        $this->pluginManager = $pluginManager;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRepository(EntityManagerInterface $objectManager, $entityName)
    {
        $repositoryHash = $objectManager->getClassMetadata($entityName)->getName() . spl_object_hash($objectManager);

        if (isset($this->repositoryList[$repositoryHash])) {
            return $this->repositoryList[$repositoryHash];
        }

        return $this->repositoryList[$repositoryHash] = $this->createRepository($objectManager, $entityName);
    }

    /**
     * Create a new repository instance for an entity class.
     *
     * @param \Doctrine\ORM\EntityManagerInterface $objectManager The EntityManager instance.
     * @param string                               $entityName    The name of the entity.
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function createRepository(EntityManagerInterface $objectManager, $entityName)
    {
        /* @var $metadata \Doctrine\ORM\Mapping\ClassMetadata */
        $metadata = $objectManager->getClassMetadata($entityName);
        $repositoryClassName = ($metadata->customRepositoryClassName) ?:
            $objectManager->getConfiguration()->getDefaultRepositoryClassName();

        $instance = new $repositoryClassName($objectManager, $metadata);
        $instance->setPluginManager($this->pluginManager);

        return $instance;
    }
}
