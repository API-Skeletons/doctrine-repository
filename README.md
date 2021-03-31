doctrine-repository
======================

[![Build Status](https://travis-ci.org/API-Skeletons/doctrine-repository.svg?branch=master)](https://travis-ci.org/API-Skeletons/doctrine-repository)
[![Gitter](https://badges.gitter.im/api-skeletons/open-source.svg)](https://gitter.im/api-skeletons/open-source)
[![Total Downloads](https://poser.pugx.org/api-skeletons/doctrine-repository/downloads)](https://packagist.org/packages/api-skeletons/doctrine-repository)

This is a replacement for the default repository structure of
Doctrine ORM.  This replacement implements a plugin architecture
for extensisons to repositories.

For instance, if you need access to an encryption/decryption resource
inside your repository you could implement it as a plugin accessible as

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
$ composer require api-skeletons/doctrine-repository
```

Once installed, add `ZF\Doctrine\Repository` to your list of modules inside
`config/application.config.php` or `config/modules.config.php`.

> ### laminas-component-installer
>
> If you use [laminas-component-installer](https://github.com/laminas/laminas-component-installer),
> that plugin will install doctrine-repository as a module for you.


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

The config key for the repository plugin service locator is `api-skeletons-doctrine-repository-plugin`.
Your plugin must implement `ZF\Doctrine\Repository\Plugin\PluginInterface`

The `__construct` of your Plugin will take an array including the repository and any other parameters.
Access to the repository gives you access to the ObjectManager.

Use the
[testing boolean plugin](https://github.com/API-Skeletons/doctrine-repository/blob/master/test/asset/module/Doctrine/src/Plugin/BooleanPlugin.php)
and [testing boolean plugin configuration](https://github.com/API-Skeletons/doctrine-repository/blob/master/test/asset/module/Doctrine/config/module.config.php)
as a template.

