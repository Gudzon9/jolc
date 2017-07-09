<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Direction */

$this->title = 'Update Direction: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Directions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="direction-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
