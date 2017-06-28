<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;
use common\models\Branch;
use common\models\District;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BranchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Відділення';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="branch-index">

    <p>
        <?= Html::a('Новий запис', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'type',
                'filter' => [Branch::BRANCH_MASTER => 'Головне', Branch::BRANCH_SLAVE => 'Підпорядковане',],
            ],
            'description:ntext',        
            [
                'format' => 'html',
                'value' => function($model){
                    $str = '';
                    $aDistrict = District::find()->Where(['branch_id'=>$model->id])->asArray()->all();
                    foreach ($aDistrict As $item)
                    {
                        $str .= $item['name'].'<br>';
                    }
                    return $str;
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
