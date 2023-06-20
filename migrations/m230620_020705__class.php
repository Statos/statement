<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m230620_020705__class
 */
class m230620_020705__class extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('student_class', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);

        $classes = (new Query())
            ->from('student')
            ->select(new \yii\db\Expression('DISTINCT class'))
            ->column();

        foreach ($classes as $class) {
            $this->insert('student_class', ['name' => $class]);
        }

        $this->addColumn('student', 'class_id',
            $this->integer()->defaultValue(null)
        );

        $students = (new Query())->from('student')->all();
        foreach ($students as $student) {
            $classId = (new Query())
                ->from('student_class')
                ->andWhere(['name' => $student['class']])
                ->select('id')
                ->scalar();

            $this->update('student', ['class_id' => $classId], ['id' => $student['id']]);
        }

        $this->alterColumn('student', 'class_id',
            $this->integer()->notNull()
        );

        $this->addForeignKey('student_class_id',
            'student', 'class_id',
            'student_class', 'id', 'RESTRICT', 'CASCADE'
        );

        $this->dropColumn('student', 'class');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('student', 'class', $this->string(255)->defaultValue(null));

        $students = (new Query())
            ->from('student s')
            ->leftJoin('student_class c', 'c.id = s.class_id')
            ->select(['s.id', 'class_name' => 'c.name'])
            ->all();
        foreach ($students as $student) {
            $this->update('student', ['class' => $student['class_name']], ['id' => $student['id']]);
        }

        $this->alterColumn('student', 'class', $this->string(255)->notNull());

        $this->dropForeignKey('student_class_id', 'student');
        $this->dropColumn('student', 'class_id');
        $this->dropTable('student_class');
    }

}
