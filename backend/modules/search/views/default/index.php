<?php

/* @var $this yii\web\View */
/* @var $query string */

?>
<div class="search-default-index">
    <h1><?= Yii::t('menst.cms', 'Search') ?></h1>

    <?php echo \gromver\cmf\common\widgets\SearchForm::widget([
        'id' => 'bSearchForm',
        'query' => $query,
        'showPanel' => false
    ]);

    echo \gromver\cmf\common\widgets\SearchResults::widget([
        'id' => 'bSearchResult',
        'query' => $query,
        'filters' => []
    ]); ?>
</div>
