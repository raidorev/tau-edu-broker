<?php

namespace app\models\conflict;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ConflictSearch extends Conflict
{
    public $membersIds;
    public $brokerIds;

    public function rules(): array
    {
        return [
            [['id', 'status_id'], 'integer'],
            [['membersIds', 'brokerIds'], 'safe'],
        ];
    }

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
        $query = Conflict::find()
            ->alias('c')
            ->innerJoinWith('entrants e')
            ->innerJoinWith('brokers b');

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
            'c.status_id' => $this->status_id,
            'e.id' => $this->membersIds,
            'b.id' => $this->brokerIds,
        ]);

        return $dataProvider;
    }
}
