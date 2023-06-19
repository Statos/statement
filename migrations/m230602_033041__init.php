<?php

use yii\db\Migration;

/**
 * Class m230602_033041__init
 */
class m230602_033041__init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('student', [
            'id' => $this->primaryKey(),
            'last_name' => $this->string(255)->notNull(),
            'first_name' => $this->string(255)->notNull(),
            'patronymic' => $this->string(255)->notNull(),
            'class' => $this->string(255)->notNull()
        ]);
        $this->addColumn('student', 'fio',
            'VARCHAR(1024) GENERATED ALWAYS AS (CONCAT(last_name, " ", first_name, " ", patronymic)) VIRTUAL'
        );

        $this->createTable('lesson', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'fio_teacher' => $this->string(255)->notNull(),
        ]);

        $this->createTable('grade', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer()->notNull(),
            'lesson_id' => $this->integer()->notNull(),
            'year' => $this->integer()->notNull(),
            'quarter' => $this->integer()->notNull(),
            'grade' => $this->tinyInteger()->unsigned()->notNull()
        ]);
        $this->addForeignKey('grade_student_id',
            'grade', 'student_id',
            'student', 'id', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey('grade_lesson_id',
            'grade', 'lesson_id',
            'lesson', 'id', 'CASCADE', 'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('grade');
        $this->dropTable('lesson');
        $this->dropTable('student');
    }

}
