<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\ClubSearch $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerCssFile('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/flatpickr', ['depends' => [\yii\web\JqueryAsset::class]]);


?>

<div class="club-search mb-4">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true],
    ]); ?>

    <div class="mb-2">
    <?= $form->field($model, 'name') ?>
    </div>

    <div class="mb-2">

        <?= $form->field($model, 'showArchived')->checkbox([
            'label' => 'Archived',
        ]) ?>
    </div>
    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
