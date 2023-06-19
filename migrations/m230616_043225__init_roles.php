<?php


class m230616_043225__init_roles extends \app\components\db\PermissionMigration
{
    public $add = [
        [
            'admin',
            ['/admin/*', '/user/*', '/student/*', '/lesson/*', '/grade/*', '/gii/*']
        ],
        [
            'teacher',
            ['/student/*', '/lesson/*', '/grade/*']
        ],
        [
            'parent',
            ['/grade/index', '/grade/total']
        ]
    ];
}
