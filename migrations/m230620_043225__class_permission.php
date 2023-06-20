<?php


class m230620_043225__class_permission extends \app\components\db\PermissionMigration
{
    public $add = [
        [
            'admin',
            ['/student-class/*', '/student-class/index']
        ],
    ];

    public $menu = [
        ['Классы', null, '/student-class/index', null],
    ];

    public function safeUp()
    {
        parent::safeUp();

        foreach ($this->menu as $menu) {
            $parentId = null;
            if ($menu[1]) {
                $parentId = (new \yii\db\Query())
                    ->from('menu')
                    ->andWhere(['name' => $menu[1]])
                    ->select('id')
                    ->scalar();
            }

            $this->insert('menu', [
                'name' => $menu[0],
                'parent' => $parentId,
                'route' => $menu[2],
                'order' => $menu[3],
            ]);
        }
    }
}
