DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      models/             contains model classes
      runtime/            contains files generated during runtime
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.4.


INSTALLATION
------------

### Install via Composer

If you do not have [Composer](https://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar install
~~~

Now you should be able to access the application through the following URL

~~~
http://statement
~~~

### Migrations
```
php yii migrate --migrationPath=@mdm/admin/migrations
php yii migrate --migrationPath=@yii/rbac/migrations
php yii migrate
```

### RBAC

```
php yii rbac/init
```

### FAST-RUN

```
php yii migrate --migrationPath=@mdm/admin/migrations --interactive=0 \
    && php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0 \
    && php yii migrate --interactive=0 \
    && php yii rbac/init
```
