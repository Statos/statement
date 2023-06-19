<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grade".
 *
 * @property int $id
 * @property int $student_id
 * @property int $lesson_id
 * @property int $year
 * @property int $quarter
 * @property int|null $grade
 *
 * @property Lesson $lesson
 * @property Student $student
 */
class Grade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'lesson_id', 'year', 'quarter', 'grade'], 'required'],
            [['student_id', 'lesson_id'], 'integer'],
            [['year'], 'integer', 'min' => 2000, 'max' => 2050],
            [['quarter'], 'integer', 'min' => 1, 'max' => 4],
            [['grade'], 'integer', 'min' => 1, 'max' => 5],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lesson::class, 'targetAttribute' => ['lesson_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Ученик',
            'lesson_id' => 'Урок',
            'year' => 'Год',
            'quarter' => 'Четверть',
            'grade' => 'Оценка',
        ];
    }

    /**
     * Gets query for [[Lesson]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lesson::class, ['id' => 'lesson_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['id' => 'student_id']);
    }
}
