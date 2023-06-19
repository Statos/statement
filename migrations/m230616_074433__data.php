<?php

use yii\db\Migration;

/**
 * Class m230616_074433__data
 */
class m230616_074433__data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $students = \yii\helpers\Json::decode('[
            {
                "last_name": "Попов",
                "first_name": "Виктор",
                "patronymic": "Сергеевич",
                "class": "1а",
                "fio": "Попов Виктор Сергеевич"
            },
            {
                "last_name": "Шаповалов",
                "first_name": "Леонид",
                "patronymic": "Игоревич",
                "class": "1б",
                "fio": "Шаповалов Леонид Игоревич"
            },
            {
                "last_name": "Ефремов",
                "first_name": "Сергей",
                "patronymic": "Сергеевич",
                "class": "2б",
                "fio": "Ефремов Сергей Сергеевич"
            },
            {
                "last_name": "Попова",
                "first_name": "Виктория",
                "patronymic": "Павловна",
                "class": "2а",
                "fio": "Попова Виктория Павловна"
            }
        ]');

        $this->batchInsert('student', ['last_name', 'first_name', 'patronymic', 'class', 'fio'], $students);

        $lessons = \yii\helpers\Json::decode('[
            {
                "name": "Русский",
                "fio_teacher": "Иванова Елена Анатольевна"
            },
            {
                "name": "Математика",
                "fio_teacher": "Хорнева Мила Викторовна"
            },
            {
                "name": "География",
                "fio_teacher": "Орлова Татьяна Александровна"
            }
        ]');

        $this->batchInsert('lesson', ['name', 'fio_teacher'], $lessons);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230616_074433__data cannot be reverted.\n";

        return false;
    }

}
