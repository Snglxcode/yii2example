<?php

use frontend\models\enums\GenderEnum;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\ClientSearch $model */
/** @var yii\widgets\ActiveForm $form */




$js = <<<JS
    flatpickr(".flatpickr-range", {
        mode: "range",
        dateFormat: "Y-m-d"
    });
JS;
$this->registerJs($js);
?>

<div class="client-search mb-4">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true],
    ]); ?>

<!--    --><?php //= $form->field($model, 'id') ?>
    <div class="mb-2">
    <?= $form->field($model, 'full_name') ?>
    </div>

    <div class="mb-2">

        <?= $form->field($model, 'gender')->radioList(
            GenderEnum::getValues(),
            [
                'item' => function($index, $label, $name, $checked, $value) use ($model) {
                    return Html::radio($name, $model->gender==$label, [
                        'value' => $label,
                        'label' => $label,
                    ]);
                },
                'separator' => '<br>'
            ]
        ) ?>
    </div>
    <div class="mb-2">
        <?= $form->field($model, 'birth_date_range')->textInput(['class' => 'form-control flatpickr-range']) ?>
    </div>

<!--    --><?php //= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
