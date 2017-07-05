<?php

namespace ZFTest\Doctrine\Repository;

use Doctrine\ORM\Tools\SchemaTool;
use ZF\OAuth2\Doctrine\Entity;
use ZFTest\Doctrine\Repository\Entity\User;
use ZFTest\Doctrine\Repository\Entity\User2;
use Datetime;
use Exception;

abstract class AbstractTest extends \Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase
{
    public function provideStorage()
    {
        $this->setUp();

        $serviceManager = $this->getApplication()->getServiceManager();
        $config = $this->getApplication()->getConfig();
        $doctrineAdapter = $serviceManager->get('doctrine.entitymanager.orm_default');

        return array(array($doctrineAdapter));
    }

    protected function tearDown()
    {
    }

    protected function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../asset/orm.config.php'
        );

        parent::setUp();

        $serviceManager = $this->getApplication()->getServiceManager();
        $objectManager = $serviceManager->get('doctrine.entitymanager.orm_default');

        // Create database
        $tool = new SchemaTool($objectManager);
        $res = $tool->createSchema($objectManager->getMetadataFactory()->getAllMetadata());

        $user = new User();
        $user->setUsername('oauth_test_user');
        $user->setProfile('profile');
        $user->setCountry('US');
        $user->setPhoneNumber('phone');
        $user->setEmail('doctrine@zfcampus');

        $user2 = new User();

        $objectManager->persist($user);
        $objectManager->persist($user2);

        $user = new User2();
        $user->setUsername('oauth_test_user');
        $user->setProfile('profile');
        $user->setCountry('US');
        $user->setPhoneNumber('phone');
        $user->setEmail('doctrine@zfcampus');

        $user2 = new User2();

        $objectManager->persist($user);
        $objectManager->persist($user2);

        $objectManager->flush();
    }
}
