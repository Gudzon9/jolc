<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = ($model->isNewRecord ? 'Новий ' : 'Редагування').' Мета : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Мета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Новий ' : 'Редагування';
?>

<div class="mission-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'type_lab')->dropDownList(Yii::$app->params['atypeslab']) ?>

    <?php echo $form->field($model, 'type_direction')->textInput() ?>

     <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Відмова', ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
