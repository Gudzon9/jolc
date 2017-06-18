<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Branch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DistrictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider 
<h1><?= Html::encode($this->title) ?></h1>
 *  */

$this->title = 'Території';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">

    <p>
        <?= Html::a('Новий запис', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'label' => 'Відділення',
                'attribute' => 'branch_id',
                'filter' => ArrayHelper::map(Branch::find()->asArray()->all(),'id','name'),
                'value'=>function($model){
                    return $model->getBranch()->one()->name;
                    //return Branch::findOne($model->branch_id)->name;
                    //return $model->branch_id;    
                }               
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
