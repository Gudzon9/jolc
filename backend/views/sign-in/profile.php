<?php

use common\models\UserProfile;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm 
    <?php echo $form->field($model, 'locale')->dropDownlist(Yii::$app->params['availableLocales']) ?>
    <?php echo $form->field($model, 'picture')->widget(\trntv\filekit\widget\Upload::classname(), [
        'url'=>['avatar-upload']
    ]) ?>

 *  */

$this->title = Yii::t('backend', 'Edit profile')
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'middlename')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>


    <?php echo $form->field($model, 'gender')->dropDownlist([
        UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
        UserProfile::GENDER_MALE => Yii::t('backend', 'Male')
    ]) ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Update'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Повернутись', (strripos(Yii::$app->request->referrer,'account')) ? ['timeline-event/index'] : Yii::$app->request->referrer , ['class' => 'btn btn-info']) ?>    </div>

    <?php ActiveForm::end(); ?>

</div>
