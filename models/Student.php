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
 * @property string $class
 * @property-read string $fio
 *
 * @property Grade[] $grades
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
            [['last_name', 'first_name', 'patronymic', 'class'], 'required'],
            [['last_name', 'first_name', 'patronymic', 'class'], 'string', 'max' => 255],
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
            'class' => 'Класс',
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
