<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Direction;
use common\grid\EnumColumn;
use common\models\User;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $searchModel common\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Матеріали зразків';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новий запис', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'type_lab',
                'filter' => Yii::$app->params['atypeslab'],
                'value'=>function($model){
                    
                    return Yii::$app->params['atypeslab'][$model->type_lab] ;
                }               
            ],
            [
                'attribute' => 'type_direction',
                'filter' => ArrayHelper::map(Direction::find()->asArray()->all(),'id','name'),
                'value'=>function($model){
                    return $model->getDirection()->one()->name;
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
