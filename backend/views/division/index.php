<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\models\Branch;
use common\models\Division;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DivisionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Підрозділи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="division-index">

    <p>
        <?= Html::a('Новий запис', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'branch_id',
                'filter' => ArrayHelper::map(Branch::find()->asArray()->all(),'id','name'),
                'value'=>function($model){
                    return $model->getBranch()->one()->name;
                }               
            ],
            [
                'attribute' => 'type_div',
                'filter' => [Division::DIVISION_TYPE_ADM => 'Адміністрація', Division::DIVISION_TYPE_ORG => 'Орг.відділи', Division::DIVISION_TYPE_LAB => 'Лабораторії', ],
                'value'=>function($model){
                    $retval = '???';    
                    switch ($model->type_div) {
                        case Division::DIVISION_TYPE_ADM :
                            $retval = 'Адміністрація';
                            break;
                        case Division::DIVISION_TYPE_ORG :
                            $retval = 'Орг.відділи';
                            break;
                        case Division::DIVISION_TYPE_LAB :
                            $retval = 'Лабораторії';
                            break;
                    }
                
                    return $retval ;
                }               
            ],
            [
                'attribute' => 'type_lab',
                'filter' => Yii::$app->params['atypeslab'],
                'value'=>function($model){
                    return Yii::$app->params['atypeslab'][$model->type_lab];
                }               
            ],
            [
                'attribute' => 'created_at',
                'format'=>'datetime',
                        'filter' => DateRangePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'created_range',
                            'convertFormat' => true,
                            'pluginOptions' => [
                                'locale' => [
                                    'format' => 'Y-m-d'
                                ],
                            ],
                        ]),
            ],        
            [
                'attribute' => 'created_by',
                'filter' => ArrayHelper::map(User::find()->innerJoin('district', 'district.created_by=user.id')->asArray()->all(),'id','username'),
                'value'=> function($model) {return User::findOne($model->created_by)->username;},
            ],  
            [
                'attribute' => 'updated_at',
                'format'=>'datetime',
                        'filter' => DateRangePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'updated_range',
                            'convertFormat' => true,
                            'pluginOptions' => [
                                'locale' => [
                                    'format' => 'Y-m-d'
                                ],
                            ],
                        ]),
            ],  
            [
                'attribute' => 'updated_by',
                'filter' => ArrayHelper::map(User::find()->innerJoin('district', 'district.updated_by=user.id')->asArray()->all(),'id','username'),
                'value'=> function($model) {
                    return User::findOne($model->updated_by)->username;
                },
            ],  
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
