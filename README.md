zf-doctrine-repository
======================

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

The default repository for Doctrine ORM gives little access to resources
outside Doctrine.  And the Doctrine ORM Object Manager does not give 
access to a dependency injection container.  So when your applications 
require more from their repositories the only option is to write your 
own dependency injection enabled repository factory.  To create a standard
way to organize this dependency injection repository factory this is
an acceptable solution.


Example of a future plugin 
--------------------------

This repository is forward-looking and architected to support the needs 
today and into the future.  Here are examples of repository plugins 
to be developed:

Audit - A trigger-happy application will create a structure of triggers 
on all tables accessible as Doctrine entities.  Data would be accessible
directly or to access the audit data with a plugin:
```
use Database\Entity\User;

$objectManager->getRepository(User::class)->plugin('audit')->trail($id);
```

Query Provider - [zfcampus/zf-apigility-doctrine](https://github.com/zfcampus/zf-apigiltiy-doctrine) includes Query Providers which may take the current authenticated user and add complex filters to a a QueryBuilder object in order to filter whether the user has access to a given entity.  This filtering mechanism can be used across a whole application whenever authorized access is needed to an entity.
```
use Database\Entity\User;

$objectManager->getRepository(User::class)->plugin('queryProvider')->find($id);
```

