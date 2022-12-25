<!DOCTYPE html>

<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\models\Currency;

?>

<?php $form = ActiveForm::begin([]) ?>

<div align=center>
    <H1>
        Hello!</br>
        You are on the site for currency conversion.
    </H1></br>
    <H2>
        Select the currency you want to convert from
    </H2>
    <div>
        <?php
            echo $form->field($form_model, 'FirstCurrency', ['enableLabel' => false])->dropdownList(
                Currency::find()->select(['CharCode'])->indexBy('CharCode')->column(),
                    [
                        'style' => 'width:150px !important', 
                        'prompt' => NULL,

                    ]
            );
        ?>
    </div>
    <H2>
        Enter the amount to convert
    </H2>
    <div>
        <?= $form->field($form_model, 'FirstSumm', ['enableLabel' => false])
                ->textInput(
                    ['style'=>'width:20%']
                    );
        ?>
    </div>
    <H2>
        And select the currency you want to convert to
    </H2>
    <div>
        <?php
            echo $form->field($form_model, 'SecondCurrency', ['enableLabel' => false])->dropdownList(
                Currency::find()->select(['CharCode'])->indexBy('CharCode')->column(),
                    [
                        'style' => 'width:150px !important; color: red, width: auto',
                        'prompt' =>  NULL,
                    ]
            );
        ?>
    </div>
    <div>
        <?= Html::submitButton('Convert', ['class' => 'btn btn-primary']) ?>
    </div></br>

    <?php if ($form_model->SecondSumm): ?>
        <div style="background-color:lime;">
            <H2>
                Result:
                <?php
                    echo "$form_model->FirstSumm $form_model->FirstCurrency is $form_model->SecondSumm $form_model->SecondCurrency"
                ?>
            </H2>
        </div>
    <?php endif; ?>

</div>


<?php ActiveForm::end() ?> 

