<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\District;
use common\models\Branch;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Branch */
/* @var $form yii\widgets\ActiveForm */
$this->title = ($model->isNewRecord ? 'Новий ' : 'Редагування').' Відділення : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Відділення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Новий ' : 'Редагування';
?>

<div class="branch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->dropDownList([Branch::BRANCH_MASTER => 'Головне', Branch::BRANCH_SLAVE => 'Підпорядковане',]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?php if(!$model->isNewRecord) {
        echo Select2::widget([
                            'name' => 'prkag',
                            'data' => ArrayHelper::map(District::find()->Where(['branch_id'=>$model->id])->all(),'id','name'),
                            'value' => ArrayHelper::getColumn(District::find()->Where(['branch_id'=>$model->id])->asArray()->all(), 'id'),
                            'options' => ['placeholder' => 'Території ...', 'multiple' => true, 'disabled'=>true],
                            'pluginOptions' => [
                                'tags' => true,
                                'tokenSeparators' => [',', ' '],
                                'maximumInputLength' => 2
                            ],
                        ]);
    } ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Відмова', ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
