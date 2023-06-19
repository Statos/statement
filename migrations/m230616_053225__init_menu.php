<?php


class m230616_053225__init_menu extends \app\components\db\PermissionMigration
{

    public $menu = [
        ['Администрирование', null, null, null],
        ['Пользователи', 'Администрирование', '/user/index', 5],
        ['Роли и права', 'Администрирование', '/admin/default/index', 10],

        ['Ученики', null, '/student/index', null],
        ['Уроки', null, '/lesson/index', null],
        ['Оценки', null, null, null],
        ['Оценки учеников', 'Оценки', '/grade/index', 5],
        ['Итоговая оценка', 'Оценки', '/grade/total', 10],
    ];

    public function safeUp()
    {
        foreach ($this->menu as $menu) {
            if ($menu[2]) {
                $this->createOrGetPermission($menu[2], $menu[2]);
            }

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

    public function safeDown()
    {
        $this->delete('menu');
    }
}
