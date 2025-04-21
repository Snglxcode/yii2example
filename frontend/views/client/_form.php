<?php

use frontend\models\Club;
use frontend\models\enums\GenderEnum;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Client $model */
/** @var yii\widgets\ActiveForm $form */

$js = <<<JS
    flatpickr(".flatpickr-range", {
        dateFormat: "Y-m-d"
    });
JS;
$this->registerJs($js);

?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->errorSummary($model, [
        'header' => 'Validation Errors:',
        'class' => 'alert alert-danger',
    ]);
    ?>

    <div class="mb-2">

        <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
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
        <?= $form->field($model, 'birth_date')->textInput(['class'=>'form-control flatpickr-range']) ?>
    </div>
    <div class="mb-2">
    <?= $form->field($model, 'club_ids')->label('Clubs')->listBox(
        ArrayHelper::map(Club::find()->all(), 'id', 'name'),
        ['multiple' => true, 'size' => 10]
    ) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
