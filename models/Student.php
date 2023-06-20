<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string $patronymic
 * @property int $class_id
 * @property-read string $fio
 *
 * @property Grade[] $grades
 * @property StudentClass $studentClass
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_name', 'first_name', 'patronymic', 'class_id'], 'required'],
            [['last_name', 'first_name', 'patronymic'], 'string', 'max' => 255],
            [['class_id'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentClass::class, 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'patronymic' => 'Отчество',
            'fio' => 'ФИО',
            'class_id' => 'Класс',
        ];
    }

    /**
     * Gets query for [[Grades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrades()
    {
        return $this->hasMany(Grade::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[StudentClass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentClass()
    {
        return $this->hasOne(StudentClass::class, ['id' => 'class_id']);
    }

    public function getFio()
    {
        return implode(' ', [$this->last_name, $this->first_name, $this->patronymic]);
    }

    public static function getDropDown()
    {
        return ArrayHelper::map(
            self::find()->select([
                'id',
                'fio' => new Expression('CONCAT(last_name, " ", first_name, " ", patronymic)')
            ])->all(),
            'id',
            'fio'
        );
    }
}
