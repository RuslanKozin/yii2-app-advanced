<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Interview */
/* @var $form ActiveForm */
?>
<div class="site-interview">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'version') ?>
        <?= $form->field($model, 'apply_time') ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-interview -->
