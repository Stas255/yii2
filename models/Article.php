<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $date
 * @property string|null $image
 * @property string|null $tag
 * @property int|null $viewed
 * @property int|null $topic_id
 * @property int|null $user_id
 *
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'tag', 'topic_id', 'user_id'], 'required'],
            [['title', 'description'], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['viewed'], 'default', 'value' => 0],
            [['title'], 'string', 'max' => 255],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'image' => 'Image',
            'tag' => 'Tag',
            'viewed' => 'Viewed',
            'topic_id' => 'Topic ID',
            'user_id' => 'User ID',
        ];
    }

    public function saveImage($filename)
    {
        $this->image = $filename;

        return $this->save(false);
    }

    public function getImage()
    {
        if ($this->image) {
            return '/uploads/' . $this->image;
        }
        return '/no-image.png';
    }

    public function getTopic()
    {
        return $this->hasOne(Topic::className(), ['id' => 'topic_id']);
    }

    public function deleteImage()
    {
        $imageUploadModel = new ImageUpload();
        $imageUploadModel->deleteCurrentImage($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

    public static function getAll($pageSize = 5)
    {
        $query = Article::find();

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

    public function saveArticle()
    {
        $this->user_id = Yii::$app->user->id;
        return $this->save();
    }

    public function getComments()
    {

        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function viewedCounter()
    {
        $this->viewed +=1;
        return $this->save(false);
    }
}

