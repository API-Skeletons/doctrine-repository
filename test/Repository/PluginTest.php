<?php

namespace ZFTest\Doctrine\Repository;

use ZFTest\Doctrine\Repository\Entity\User;
use ZFTest\Doctrine\Repository\Entity\User2;

class PluginTest extends AbstractTest
{
    /** @dataProvider provideStorage */
    public function testDoctrineConnection($storage)
    {
        $this->assertInstanceOf('Doctrine\ORM\EntityManager', $storage);

        $repository = $storage->getRepository(User::class);
        $repository2 = $storage->getRepository(User2::class);

        $this->assertInstanceOf('ZF\Doctrine\Repository\ObjectRepository', $repository);
        $this->assertTrue($repository->plugin('boolean')->getBoolean(true));
        $this->assertFalse($repository->plugin('boolean')->getBoolean(false));

        $user = $repository->plugin('boolean')->getEntityName();
        $user2 = $repository2->plugin('boolean')->getEntityName();

        $this->assertNotEquals($user, $user2);
    }
}
