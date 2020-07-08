<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "topic".
 *
 * @property int $id
 * @property string|null $name
 */
class Topic extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function getArticles(){
        return $this->hasMany(Article::className(),['topic_id'=>'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function getArticlesByTopic($id,$pageSize = 5)
    {
        $query = Article::find()->where(['topic_id'=>$id]);

        $count = $query->count();

        // create a pagination object with the total count
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        // limit the query using the pagination and retrieve the articles
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data['articles'] = $articles;
        $data['pagination'] = $pagination;


        return $data;

    }
}
