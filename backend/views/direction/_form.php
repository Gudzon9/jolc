<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = ($model->isNewRecord ? 'Новий ' : 'Редагування').' Напрямок досліджень: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Напрямок досліджень', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Новий ' : 'Редагування';
?>

<div class="direction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'type_lab')->dropDownList(Yii::$app->params['atypeslab']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Відмова', ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
