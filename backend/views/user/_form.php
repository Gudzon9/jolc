<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Branch;
use common\models\Division;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] 
        <?php echo $form->field($model, 'email') ?>

 * 
 *  */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->field($model, 'username') ?>
        <?php echo $form->field($model, 'password')->passwordInput() ?>
        <?php echo $form->field($model, 'branch_id')->dropDownList(ArrayHelper::map(Branch::find()->asArray()->all(),'id','name')) ?>
        <?php echo $form->field($model, 'branch_access')->dropDownList([
            User::BRANCH_OWN => 'Тільки своє відділення',
            User::BRANCH_ALL => 'Всі відділення'
            ],['disabled'=>false]) 
        ?>
        <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
        <?php echo $form->field($model, 'roles')->checkboxList($roles) ?>
        <div class="form-group">
            <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
