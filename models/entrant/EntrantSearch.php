<?php

namespace app\models\entrant;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EntrantSearch represents the model behind the search form of `app\models\entrant\Entrant`.
 */
class EntrantSearch extends Entrant
{
    public $filled;

    public function rules(): array
    {
        return [
            [
                [
                    'id',
                    'future_educational_program_id',
                    'sex_id',
                ],
                'integer',
            ],
            [
                [
                    'first_name',
                    'last_name',
                    'patronymic',
                    'phone_number',
                    'email',
                    'birthdate',
                    'filled',
                ],
                'safe',
            ],
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
        $query = Entrant::find();

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

        $query->andFilterWhere([
            'id' => $this->id,
            'future_educational_program_id' =>
                $this->future_educational_program_id,
            'sex_id' => $this->sex_id,
            'birthdate' => $this->birthdate,
        ]);

        if ($this->filled === '1') {
            $conditions = [];
            foreach (
                parent::scenarios()[Entrant::SCENARIO_STAGE_TWO]
                as $attribute
            ) {
                $conditions[] = ['NOT', [$attribute => null]];
            }
            $query->andWhere(['AND', ...$conditions]);
        } elseif ($this->filled === '0') {
            $conditions = [];
            foreach (
                parent::scenarios()[Entrant::SCENARIO_STAGE_TWO]
                as $attribute
            ) {
                $conditions[] = [$attribute => null];
            }
            $query->andWhere(['OR', ...$conditions]);
        }

        $query
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'patronymic', $this->patronymic])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
