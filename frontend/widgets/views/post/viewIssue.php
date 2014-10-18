<?php
/**
 * @var $this yii\web\View
 * @var $model \menst\cms\common\models\Post
 */

use yii\helpers\Html;

if ($this->context->showTranslations) {
    echo \menst\cms\frontend\widgets\Translations::widget([
        'model' => $model,
        'options' => [
            'class' => 'pull-right'
        ]
    ]);
} ?>

<h2 class="issue-header"><?= Html::encode($model->title) ?></h2>

<div class="issue-bar">
    <small class="issue-published"><?= Yii::$app->formatter->asDatetime($model->published_at) ?></small>
    <small class="issue-separator">|</small>
    <?php foreach ($model->tags as $tag) {
        /** @var $tag \menst\cms\common\models\Tag */
        echo Html::a($tag->title, ['/cms/tag/default/posts', 'tag_id' => $tag->id, 'tag_alias' => $tag->alias], ['class' => 'issue-tag badge']);
    } ?>
</div>

<?php if($model->detail_image) {
    echo Html::img($model->getFileUrl('detail_image'), [
        'class' => 'text-block img-responsive',
        //'style' => 'max-width: 200px; margin-right: 15px;'
    ]);
} ?>

<div class="issue-text"><?= $model->detail_text ?></div>

<style>
    .issue-bar {
        border-top: 1px solid #cccccc;
        padding: 6px;
        margin-bottom: 1.8em;
        background-color: #FCF4F4;
        font-size: 12px;
    }
    .issue-separator {
        margin: 0 8px;
    }
    .issue-tag {
        font-size: 10px;
        margin-right: 0.8em;
    }
</style>