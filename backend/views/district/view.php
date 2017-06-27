<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\District */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Території', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
/*
 * <h1><?= Html::encode($this->title) ?></h1>
 */
?>
<div class="district-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('До списку', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Редагування', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалення', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Видалити запис?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'branch_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>
    <h3>Історія змін</h3>
    <?= GridView::widget([
        'dataProvider' => $slogProvider,
        'columns' => [
            [
                'attribute' => 'created_at',
                'format'=>'datetime',
            ],    
            [
                'attribute' => 'tbl_name',
            ],    
            [
                'attribute' => 'id_intbl',
            ],    
            [
                'attribute' => 'data_befor',
                'format'=>'html',
                'value'=> function($model){
                    $data = json_decode($model->data_befor);
                    return DetailView::widget(['model' => $data,]);
                },
            ],    
            [
                'attribute' => 'data_after',
                'format'=>'html',
                'value'=> function($model){
                    $data = json_decode($model->data_after);
                    return DetailView::widget(['model' => $data,]);
                },
            ],    
        ],
    ]);?>
</div>
