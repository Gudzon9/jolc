<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mission */

$this->title = 'Update Mission: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Missions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mission-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
