<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Branch;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\District */
/* @var $form yii\widgets\ActiveForm */
$this->title = ($model->isNewRecord ? 'Новий ' : 'Редагування').' Територія : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Териториї', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Новий ' : 'Редагування';
/*
 * <h1><?= Html::encode($this->title) ?></h1>
 */
?>
<div class="district-update">

    

<div class="district-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map(Branch::find()->asArray()->all(),'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>