<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use menst\cms\common\models\Category;

/**
 * @var yii\web\View $this
 * @var menst\cms\common\models\Category $model
 * @var menst\cms\common\models\Category $sourceModel
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => ['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model) ?>

    <?php if (isset($sourceModel)) {
        echo $form->field($model, 'parent_id')->dropDownList([$model->parent_id => Category::findOne($model->parent_id)->title], ['disabled' => true]);
    } else {
        echo $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(Category::find()->orderBy('lft')
            ->andWhere(['not in', 'id', $model->isNewRecord ? [] : $model->descendants()->select('id')])
            ->andWhere('id!=:id', ['id' => intval($model->id)])
            ->all(),'id', function($model){
            return str_repeat(" • ", $model->level-1) . $model->title;
        }));
    } ?>

    <?= $form->field($model, 'language')->dropDownList(Yii::$app->getLanguagesList(), ['prompt' => Yii::t('menst.cms', 'Select...')]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 1000, 'placeholder' => isset($sourceModel) ? $sourceModel->title : null]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => 255, 'placeholder' => Yii::t('menst.cms', 'Auto-generate')]) ?>

    <?//= $form->field($model, 'path')->textInput(['maxlength' => 2000]) ?>

    <?= $form->field($model, 'status')->dropDownList(['' => Yii::t('menst.cms', 'Not selected')] + $model->statusLabels()) ?>

    <?= $form->field($model, 'published_at')->widget(\kartik\widgets\DateTimePicker::className(), [
        'options' => ['value' => date('d.m.Y H:i', is_int($model->published_at) ? $model->published_at : time())],
        'pluginOptions' => [
            'format' =>  'dd.mm.yyyy hh:ii',
            'autoclose' => true,
        ]
    ]) ?>

    <?= $form->field($model, 'ordering')->textInput() ?>

    <?= $form->field($model, 'preview_text')->textarea(['rows' => 6]) ?>

    <div class="form-group container">
        <?= Html::activeLabel($model, 'detail_text') ?>
        <div>
            <?= \mihaildev\ckeditor\CKEditor::widget([
                'model' => $model,
                'attribute' => 'detail_text',
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('cms/media/manager')
            ]) ?>
        </div>
    </div>

    <?= $form->field($model, 'versionNote')->textInput() ?>

    <?= $form->field($model, 'metakey')->textarea(['maxlength' => 255]) ?>

    <?= $form->field($model, 'metadesc')->textarea(['maxlength' => 2000]) ?>

    <?= $form->field($model, 'tags')->widget(\dosamigos\selectize\Selectize::className(), [
        'options' => [
            'multiple' => true
        ],
        'items' => \yii\helpers\ArrayHelper::map($model->tags, 'id', 'title', 'group'),
        'clientOptions' => [
            'maxItems' => 'NaN'
        ],
        'url' => ['/cms/tag/default/tag-list']
    ]) ?>

    <?= $form->field($model, 'detail_image')->widget(\menst\cms\backend\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => ['showUpload' => false]
    ]) ?>

    <?= $form->field($model, 'preview_image')->widget(\menst\cms\backend\widgets\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => ['showUpload' => false]
    ]) ?>

    <?= Html::activeHiddenInput($model, 'lock') ?>

    <div>
        <?= Html::submitButton($model->isNewRecord ? Yii::t('menst.cms', 'Create') : Yii::t('menst.cms', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>