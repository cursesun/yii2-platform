<?php
/**
 * @link https://github.com/menst/yii2-cms.git#readme
 * @copyright Copyright (c) Gayazov Roman, 2014
 * @license https://github.com/menst/yii2-cms/blob/master/LICENSE
 * @package yii2-cms
 * @version 1.0.0
 */
namespace menst\cms\backend\modules\version\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use menst\cms\common\models\Version;

/**
 * Class VersionSearch represents the model behind the search form about `menst\cms\common\models\Version`.
 * @package yii2-cms
 * @author Gayazov Roman <m.e.n.s.t@yandex.ru>
 */
class VersionSearch extends Version
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'character_count', 'created_by'], 'integer'],
            [['item_class', 'version_note', 'version_hash', 'version_data', 'keep_forever'], 'safe'],
            [['created_at'], 'date', 'format' => 'dd.MM.yyyy', 'timestampAttribute' => 'created_at', 'when' => function() {
                    return is_string($this->created_at);
                }],
            [['created_at'], 'integer', 'enableClientValidation' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
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
    public function search($params)
    {
        $query = Version::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->created_at) {
            $query->andWhere('{{%cms_version}}.created_at >= :timestamp', ['timestamp' => $this->created_at]);
        }

        $query->andFilterWhere([
            '{{%cms_version}}.id' => $this->id,
            '{{%cms_version}}.item_id' => $this->item_id,
            '{{%cms_version}}.character_count' => $this->character_count,
            '{{%cms_version}}.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', '{{%cms_version}}.item_class', $this->item_class])
            ->andFilterWhere(['like', '{{%cms_version}}.version_note', $this->version_note])
            ->andFilterWhere(['like', '{{%cms_version}}.version_hash', $this->version_hash])
            ->andFilterWhere(['like', '{{%cms_version}}.version_data', $this->version_data])
            ->andFilterWhere(['like', '{{%cms_version}}.keep_forever', $this->keep_forever]);

        return $dataProvider;
    }
}