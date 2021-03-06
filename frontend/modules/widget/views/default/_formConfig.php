<?php

use yii\helpers\Html;
use gromver\platform\common\models\WidgetConfig;

/**
 * @var yii\web\View $this
 * @var gromver\models\ObjectModel $model
 * @var gromver\platform\common\widgets\Widget $widget
 * @var string $widget_id
 * @var string $widget_class
 * @var string $widget_config
 * @var string $widget_context
 * @var string $selected_context
 * @var string $url
 */

?>

<div class="config-form col-sm-12">

    <?php $form = \yii\bootstrap\ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-1',
            ]
        ]
    ]); ?>
<?= Html::errorSummary($model)?>
    <?= Html::hiddenInput('widget_id', $widget_id) ?>

    <?= Html::hiddenInput('widget_class', $widget_class) ?>

    <?= Html::hiddenInput('widget_context', $widget_context) ?>

    <?= Html::hiddenInput('selected_context', $selected_context) ?>

    <?= Html::hiddenInput('url', $url) ?>

    <?= Html::hiddenInput('widget_config', $widget_config) ?>

    <div class="controls-bar">
        <div class="pull-right">
            <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-save"></span> ' . Yii::t('gromver.platform', 'Save'), ['class' => 'btn btn-success', 'name'=>'task', 'value'=>'save']) ?>
            <?php if(WidgetConfig::find()->where(['widget_id' => $widget_id, 'context' => $selected_context])->exists()) {
                echo Html::submitButton('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('gromver.platform', 'Delete'), ['class' => 'btn btn-danger', 'name'=>'task', 'value'=>'delete']);
            } ?>
        </div>
        <div class="method pull-left">
            <?= Html::checkbox('bulk-method', false, ['label' => Yii::t('gromver.platform', 'Apply action to the subordinated contexts')])?>
        </div>
    </div>

    <div class="context-bar form-group">
        <?= $this->render('_contexts', [
                'widget_id' => $widget_id,
                'widget_context' => $widget_context,
                'selected_context' => $selected_context,
                'loaded_context' => $widget->getLoadedContext()
            ]); ?>
    </div>

    <?= \gromver\models\widgets\Fields::widget(['model' => $model]) ?>

    <?php \yii\bootstrap\ActiveForm::end(); ?>

</div>

<?
$this->registerJs('$("#'.$form->getId().'").on("refresh.form", function(){
    $(this).find("button[value=\'refresh\']").click()
})');
?>

<style>
    form.form-horizontal {
        padding-top: 70px;
    }

    .controls-bar {
        position: fixed;
        z-index: 100;
        left: 15px;
        right: 15px;
        top: 0;
        height: 50px;
        background-color: #ffffff;
        border-bottom: 2px solid #999;
    }
    .controls-bar .context-info {
        margin-top: 8px;
    }

    .context-bar .separator {
        line-height: 34px;
    }
    .context-bar .undefined {
        color: #999999;
    }
    .context-bar .loaded {
        font-weight: bold;
    }
    .context-bar .selected {
        margin: 0 12px;
        border: 1px solid #999999;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
</style>