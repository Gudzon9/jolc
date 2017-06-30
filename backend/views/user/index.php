<?php

use common\grid\EnumColumn;
use common\models\User;
use common\models\Branch;
use common\models\Division;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', ['modelClass' => 'User',]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'username',
            [
                'attribute' => 'branch_id',
                'filter' => ArrayHelper::map(Branch::find()->asArray()->all(),'id','name'),
                'value'=>function($model){
                    return Branch::findOne($model->branch_id)->name;
                }               
            ],
            [
                'attribute' => 'division_id','filter' => false,
                'value'=>function($model){
                    return Division::findOne($model->division_id)->name;
                }               
            ],
            [
                'class' => EnumColumn::className(),
                'attribute' => 'level_access',
                'enum' => User::levelaccess(),
                'filter' => User::levelaccess()
            ],
            [
                'class' => EnumColumn::className(),
                'attribute' => 'status',
                'enum' => User::statuses(),
                'filter' => User::statuses()
            ],
            'created_at:datetime',
            'logged_at:datetime',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
