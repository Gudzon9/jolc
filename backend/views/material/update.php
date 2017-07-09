<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Material */

$this->title = 'Update Material: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="material-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
