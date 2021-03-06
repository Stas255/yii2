<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'format' => 'ntext',
                'label' => 'description',
                'value' => function ($data) {
                    return mb_strimwidth($data->description,0, 360, "...");
                }
            ],
            'date',
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function ($data) {
                    return Html::img($data->getImage(), ['width' => 200]);
                }
            ],
            //'tag',
            //'viewed',
            //'topic_id',
            //'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
