zf-doctrine-repository
======================

[![Build Status](https://travis-ci.org/api-skeletons/zf-doctrine-repository.svg?branch=master)](https://travis-ci.org/api-skeletons/zf-doctrine-repository)
[![Total Downloads](https://poser.pugx.org/api-skeletons/zf-doctrine-repository/downloads)](https://packagist.org/packages/api-skeletons/zf-doctrine-repository)

This is a replacement for the default repository structure of
Doctrine ORM.  This replacement implements a plugin architecture
for extensisons to repositories.

For instance, if you need access to an encryption/decryption resource
inside your entity you could implement it as a plugin accessible as

```php
$this->plugin('encryption')->encrypt($value);
```


Why use this repository structure?
----------------------------------

The default repository for Doctrine ORM gives no access to resources
outside Doctrine.  And the Doctrine ORM Object Manager does not give
access to a dependency injection container.  So when your applications
require more from their repositories the only option is to write your
own dependency injection enabled repository factory.  To create a standard
way to organize this dependency injection repository factory: this is
an acceptable solution.


Installation
------------

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```bash
$ composer require api-skeletons/zf-doctrine-repository
```

Once installed, add `ZF\Doctrine\Repository` to your list of modules inside
`config/application.config.php` or `config/modules.config.php`.

> ### zf-component-installer
>
> If you use [zf-component-installer](https://github.com/zendframework/zf-component-installer),
> that plugin will install zf-doctrine-repository as a module for you.


Configuration
-------------

No manual configuration is required to use this module.

This module makes these changes to your
`doctrine.entitymanager.orm_default` configuration:

```
namespace ZF\Doctrine\Repository;
...
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'repository_factory' => RepositoryFactory::class,
                'default_repository_class_name' => ObjectRepository::class,
            ],
        ],
    ],
```

If your application already has a default repository class you can edit it to implement
`ZF\Doctrine\Repository\ObjectRepositoryInterface` and the RepositoryFactory can use it.


Creating a Plugin
-----------------

The config key for the repository plugin service locator is `zf-doctrine-repository-plugin`.
Your plugin must implement `ZF\Doctrine\Repository\Plugin\PluginInterface`

The `__construct` of your Plugin will take an array including the repository and any other parameters.
Access to the repository gives you access to the ObjectManager.

Use the
[testing boolean plugin](https://github.com/API-Skeletons/zf-doctrine-repository/blob/master/test/asset/module/Doctrine/src/Plugin/BooleanPlugin.php)
and [testing boolean plugin configuration](https://github.com/API-Skeletons/zf-doctrine-repository/blob/master/test/asset/module/Doctrine/config/module.config.php)
as a template.


Available Plugins
-----------------

**zf-doctrine-repository-query-provider** - [zfcampus/zf-apigility-doctrine](https://github.com/zfcampus/zf-apigiltiy-doctrine)
includes Query Providers which may take the current authenticated user and add complex filters to a a QueryBuilder object in
order to filter whether the user has access to a given entity.  This filtering mechanism can be used across a whole
application whenever authorized access is needed to an entity.

```
use Database\Entity\User;

// Return a single User entity fetched by applying the User Query Provider to a given `$id`
$objectManager->getRepository(User::class)->plugin('queryProvider')->find($id);
```


Future Plugin Plans
-------------------

This repository is forward-looking and architected to support the needs
today and into the future.  Here are examples of repository plugins
to be developed:

**zf-doctrine-repository-audit** - A trigger-happy application will create a structure of triggers
on all tables accessible as Doctrine entities.  Data would be accessible
directly or to access the audit data with a plugin:
```
use Database\Entity\User;

// Return the date an entity was created using the audit trail.
$objectManager->getRepository(User::class)->plugin('audit')->getCreatedAt(User $userEntity);

// Return the date an entity was last modified using the audit trail.
$objectManager->getRepository(User::class)->plugin('audit')->getUpdatedAt(User $userEntity);

// Return the complete audit trail for an entity
$objectManager->getRepository(User::class)->plugin('audit')->getAuditTrail(User $userEntity);
```
