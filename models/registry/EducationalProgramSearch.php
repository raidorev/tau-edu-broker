<?php

namespace app\models\registry;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\registry\EducationalProgram;

/**
 * EducationalProgramSearch represents the model behind the search form of `app\models\registry\EducationalProgram`.
 */
class EducationalProgramSearch extends EducationalProgram
{
    public function rules(): array
    {
        return [
            [['id', 'code'], 'integer'],
            [['name_ru', 'name_kk', 'name_en'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params): ActiveDataProvider
    {
        $query = EducationalProgram::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'code' => $this->code,
        ]);

        $query
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'name_kk', $this->name_kk])
            ->andFilterWhere(['like', 'name_en', $this->name_en]);

        return $dataProvider;
    }
}
