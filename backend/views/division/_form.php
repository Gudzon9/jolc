<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Branch;
use common\models\Division;
use yii\helpers\ArrayHelper;

$this->title = ($model->isNewRecord ? 'Новий ' : 'Редагування').' Підрозділ : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Підрозділ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? 'Новий ' : 'Редагування';
?>

<div class="division-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map(Branch::find()->asArray()->all(),'id','name')) ?>
    
    <?= $form->field($model, 'type_div')->dropDownList(Division::divtypes()) ?>
    
    <div id="dd_lab">
        <?= $form->field($model, 'type_lab')->dropDownList(Yii::$app->params['atypeslab']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Відмова', ['index'], ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*
$aAtr = json_encode(Yii::$app->params['aatr']);
$aAddAtr = json_encode($model->getAddAtrs()->asArray()->all());
$aAddComent = json_encode($model->getAddComents()->orderBy(['comentDate'=>SORT_DESC])->asArray()->all());
$ajstowns = json_encode(ArrayHelper::map(Spratr::find()->Where(['atrId'=>8])->all(),'id','lvlId'));
 */

$script = <<< JS
   function tl_control() {
        //alert(Number($('#division-type_div').val()));
       if (Number($('#division-type_div').val()) == 3) {
           $('#division-type_lab').val(0); 
           $('#dd_lab').show();
       } else {
           $('#dd_lab').hide();
       }
       
   }     
       
   $('#division-type_div').on('change',function() {tl_control();});
   tl_control();
        
JS;

$this->registerJs($script,yii\web\View::POS_END); 
