<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var \menst\cms\common\models\Version $a
 * @var \menst\cms\common\models\Version $b
 */

$this->title = Yii::t('menst.cms', 'Comparison of objects');
$this->params['breadcrumbs'][] = ['label' => 'Versions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$dummyModel = new $a->item_class;
$aData = $a->getVersionData();
$bData = $b->getVersionData();

\menst\cms\backend\modules\version\assets\TextDiffAsset::register($this);
?>
<div class="history-view">

	<h1><?= Html::encode($this->title) ?></h1>

    <table id="compare-table" class="table table-striped">
        <thead>
            <tr>
                <th><?= Yii::t('menst.cms', 'Field') ?></th>
                <th><?= Yii::t('menst.cms', 'Saved on {date}', ['date' => Yii::$app->formatter->asDatetime($a->created_at, 'd MMM Y HH:mm')]) ?></th>
                <th><?= Yii::t('menst.cms', 'Saved on {date}', ['date' => Yii::$app->formatter->asDatetime($b->created_at, 'd MMM Y HH:mm')]) ?></th>
                <th><?= Yii::t('menst.cms', 'Changes') ?></th>
            </tr>
        </thead>
        <tbody>
        <?foreach($aData as $k=>$v): ?>
            <tr>
                <th width="19%"><?= $dummyModel->getAttributeLabel($k) ?></th>
                <td class="original" width="27%"><?= ArrayHelper::getValue($aData, $k) ?></td>
                <td class="changed" width="27%"><?= ArrayHelper::getValue($bData, $k) ?></td>
                <td class="diff" width="27%"></td>
            </tr>
        <?endforeach?>
        </tbody>
    </table>

</div>

<?$this->registerJs('$("#compare-table tbody tr").prettyTextDiff()', \yii\web\View::POS_READY)?>