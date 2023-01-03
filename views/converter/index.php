<!DOCTYPE html>

<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\models\Currency;
?>

<?php
$form = ActiveForm::begin([]);

$currencyCharCodes = Currency::getСurrencyCharCodes();
?>

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
            echo $form
                    ->field($converterFormModel, 'firstCurrency', ['enableLabel' => false])
                    ->dropdownList(
                        $currencyCharCodes,
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
        <?= $form->field($converterFormModel, 'firstSumm', ['enableLabel' => false])
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
            echo $form
                    ->field($converterFormModel, 'secondCurrency', ['enableLabel' => false])
                    ->dropdownList(
                        $currencyCharCodes,
                            [
                                'style' => 'width:150px !important',
                                'prompt' => NULL,

                            ]
                        );
        ?>
    </div>
    
    <div>
        <?= Html::submitButton('Convert', ['class' => 'btn btn-primary']) ?>
    </div></br>

    <?php if ($converterFormModel->secondSumm): ?>
        <div style="background-color:lime;">
            <H2>
                Result:
                <?php
                    echo "$converterFormModel->firstSumm $converterFormModel->firstCurrency is $converterFormModel->secondSumm $converterFormModel->secondCurrency"
                ?>
            </H2>
        </div>
    <?php endif; ?>

</div>

<?php ActiveForm::end() ?> 
