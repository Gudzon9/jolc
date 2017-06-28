<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Branch;
use common\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm
 *     <?php echo $form->field($model, 'email') ?>
 * <?php echo $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map(Branch::findOne($model->branch_id),'id','name')) ?>
 * 
 *  */
$this->title = Yii::t('backend', 'Edit account')
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'username')->textInput(['readonly'=>'readonly']) ?>

    <?php echo $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map(Branch::find()->all(),'id','name'),['disabled'=>true]) ?>
    <?php echo $form->field($model, 'branch_access')->dropDownList([
        User::BRANCH_OWN => 'Тільки своє відділення',
        User::BRANCH_ALL => 'Всі відділення'
    ],['disabled'=>true]) ?>
    
    <?php echo $form->field($model, 'password')->passwordInput() ?>

    <?php echo $form->field($model, 'password_confirm')->passwordInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Повернутись', (strripos(Yii::$app->request->referrer,'profile')) ? ['timeline-event/index'] : Yii::$app->request->referrer  , ['class' => 'btn btn-info']) ?>    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
