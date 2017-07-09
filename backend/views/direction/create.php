<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Direction */

$this->title = 'Create Direction';
$this->params['breadcrumbs'][] = ['label' => 'Directions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direction-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
