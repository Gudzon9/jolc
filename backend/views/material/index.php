<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Direction;
use common\grid\EnumColumn;
use common\models\User;
use common\models\MatTagDir;
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
                'attribute' => 'type_direction',
                'filter' => false,
                'format' => 'html',
                 'value'=>function($model){
                    $str = '';
                    $aDirs = MatTagDir::find()->Where(['mat_id'=>$model->id])->asArray()->all();
                    foreach ($aDirs As $item)
                    {
                        $str .= Direction::findOne($item['dir_id'])->name.'<br>';
                    }
                    return $str;
                }               
            ],
            [
                'attribute' => 'type_lab',
                'filter' => false,
                'format' => 'html',
                'value'=>function($model){
                    $str = '';
                    $aLabs = Yii::$app->db->createCommand('SELECT d.lab_id FROM dir_tag_lab d INNER JOIN mat_tag_dir m ON m.dir_id=d.dir_id WHERE m.mat_id=:id ')
                        ->bindValue(':id', $model->id)
                        ->queryAll();
                            //MatTagDir::find()->Where(['mat_id'=>$model->id])->asArray()->all();
                    foreach ($aLabs As $item)
                    {
                        $str .= Yii::$app->params['atypeslab'][ $item['lab_id']].'<br>';
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
