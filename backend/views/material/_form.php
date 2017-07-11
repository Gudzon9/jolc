<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Direction;
use yii\helpers\ArrayHelper;
use common\models\MatTagDir;
use kartik\select2\Select2;

$this->title = ($model->isNewRecord ? 'Новий ' : 'Редагування').' Матеріали зразків : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Матеріали зразків', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Новий ' : 'Редагування';

$model->tagdir = ArrayHelper::getColumn(MatTagDir::find()->Where(['mat_id'=>$model->id])->asArray()->all(), 'dir_id');

?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'tagdir')->widget(Select2::classname(), [
            "data" => ArrayHelper::map(\common\models\Direction::find()->asArray()->all(),'id','name'), 
            "options" => ["placeholder" => "Напрямок досліджень ...","multiple" => true],
        ]); ?>
    <?php //echo $form->field($model, 'type_lab')->dropDownList(Yii::$app->params['atypeslab']) ?>

    <?php //echo $form->field($model, 'type_direction')->dropDownList(ArrayHelper::map(\common\models\Direction::find()->asArray()->all(),'id','name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Відмова', ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
