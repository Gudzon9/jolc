<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\DirTagLab;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$this->title = ($model->isNewRecord ? 'Новий ' : 'Редагування').' Напрямок досліджень: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Напрямок досліджень', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Новий ' : 'Редагування';

$model->taglab = ArrayHelper::getColumn(DirTagLab::find()->Where(['dir_id'=>$model->id])->asArray()->all(), 'lab_id');
?>

<div class="direction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'taglab')->widget(Select2::classname(), [
            "data" => Yii::$app->params['atypeslab'], 
            "options" => ["placeholder" => "Тип лабораторії ...","multiple" => true],
        ]); ?>

    <?php 
    /*
     * var_dump(ArrayHelper::getColumn(DirTagLab::find()->Where(['dir_id'=>$model->id])->asArray()->all(), 'lab_id'));
            "value" => ArrayHelper::getColumn(DirTagLab::find()->Where(['dir_id'=>$model->id])->asArray()->all(), 'lab_id'),
     * 
        echo Select2::widget([
                            'name' => 'prkag',
                            'data' => Yii::$app->params['atypeslab'],
                            'value' => ArrayHelper::getColumn(DirTagLab::find()->Where(['dir_id'=>$model->id])->asArray()->all(), 'dir_id'),
                            'options' => ['placeholder' => 'Тип лабораторії ...', 'multiple' => true, 'disabled'=>false],
                            'pluginOptions' => [
                                'tags' => true,
                                'tokenSeparators' => [',', ' '],
                                'maximumInputLength' => 2
                            ],
                        ]);
     * 
     */
    ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Відмова', ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
