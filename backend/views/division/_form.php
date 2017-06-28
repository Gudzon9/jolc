<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Branch;
use common\models\Division;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Division */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="division-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map(Branch::find()->asArray()->all(),'id','name')) ?>

    <?= $form->field($model, 'type_div')->dropDownList([Division::DIVISION_TYPE_ADM => 'Адміністрація', Division::DIVISION_TYPE_ORG => 'Орг.відділи', Division::DIVISION_TYPE_LAB => 'Лабораторії', ]) ?>

    <?= $form->field($model, 'type_lab')->dropDownList(Yii::$app->params['atypeslab']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Відмова', ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
