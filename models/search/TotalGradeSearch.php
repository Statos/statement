<?php

namespace app\models\search;

use app\models\Lesson;
use app\models\Student;
use app\models\Grade;
use yii\data\ArrayDataProvider;
use yii\db\Expression;
use yii\db\Query;

class TotalGradeSearch extends Grade
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'lesson_id', 'year'], 'integer'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $query = (new Query())
            ->from(Grade::tableName() . ' g')
            ->leftJoin(Student::tableName() . ' s', 's.id = g.student_id')
            ->leftJoin(Lesson::tableName() . ' l', 'l.id = g.lesson_id')
            ->select([
                'student' => 's.fio',
                'lesson' => 'l.name',
                'year' => 'g.year',
                'quarter1' => new Expression($this->quaSql(1)),
                'quarter2' => new Expression($this->quaSql(2)),
                'quarter3' => new Expression($this->quaSql(3)),
                'quarter4' => new Expression($this->quaSql(4)),
                'grade' => new Expression("ROUND(({$this->quaSql(1)} + {$this->quaSql(2)} + {$this->quaSql(3)} + {$this->quaSql(4)}) / 4, 2)"),
            ])
            ->groupBy(['g.student_id', 'g.lesson_id', 'g.year']);


        // add conditions that should always apply here

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return new ArrayDataProvider([
                'allModels' => [],
            ]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'student_id' => $this->student_id,
            'lesson_id' => $this->lesson_id,
            'year' => $this->year,
        ]);

        return new ArrayDataProvider([
            'allModels' => $query->all(),
        ]);
    }

    protected function quaSql($n)
    {
        return "ROUND(AVG(IF(g.quarter = $n, g.grade, null)), 2)";
    }
}
