<?php
/**
 * @link https://github.com/gromver/yii2-cmf.git#readme
 * @copyright Copyright (c) Gayazov Roman, 2014
 * @license https://github.com/gromver/yii2-cmf/blob/master/LICENSE
 * @package yii2-cmf
 * @version 1.0.0
 */

namespace gromver\cmf\frontend\widgets;

use gromver\cmf\common\widgets\Widget;
use gromver\cmf\common\models\Category;
use gromver\cmf\common\models\Post;
use yii\data\ActiveDataProvider;
use Yii;

/**
 * Class PostDay
 * @package yii2-cmf
 * @author Gayazov Roman <gromver5@gmail.com>
 */
class PostDay extends Widget {
    /**
     * @var Category|string
     * @type modal
     * @url /cmf/default/select-category
     */
    public $category;
    public $year;
    public $month;
    public $day;
    /**
     * @type list
     * @items layouts
     */
    public $layout = 'post/day';
    /**
     * @type list
     * @items itemLayouts
     */
    public $itemLayout = '_itemIssue';

    /**
     * @type list
     * @editable
     * @items sortColumns
     * @var string
     */
    public $sort = 'published_at';

    /**
     * @type list
     * @editable
     * @items sortDirections
     */
    public $dir = SORT_ASC;

    /**
     * @ignore
     */
    public $listViewOptions = [];

    protected function launch()
    {
        if ($this->category && !$this->category instanceof Category) {
            $this->category = Category::findOne(intval($this->category));
        }

        $categoryId = $this->category ? $this->category->id : null;

        echo $this->render($this->layout, [
            'dataProvider' => new ActiveDataProvider([
                    'query' => Post::find()->published()->category($categoryId)->day($this->year, $this->month, $this->day)->last(),
                    'pagination' => false,
                    'sort' => [
                        'defaultOrder' => [$this->sort => (int)$this->dir]
                    ]
                ]),
            'itemLayout' => $this->itemLayout,
            'prevDayPost' => Post::find()->published()->category($categoryId)->beforeDay($this->year, $this->month, $this->day)->last()->one(),
            'nextDayPost' => Post::find()->published()->category($categoryId)->afterDay($this->year, $this->month, $this->day)->last()->one(),
            'category' => $this->category,
            'year' => $this->year,
            'month' => $this->month,
            'day' => $this->day,
            'listViewOptions' => $this->listViewOptions
        ]);
    }

    public static function layouts()
    {
        return [
            'post/day' => Yii::t('gromver.cmf', 'Default'),
        ];
    }

    public static function itemLayouts()
    {
        return [
            '_itemArticle' => Yii::t('gromver.cmf', 'Article'),
            '_itemIssue' => Yii::t('gromver.cmf', 'Issue'),
        ];
    }

    public static function sortColumns()
    {
        return [
            'published_at' => Yii::t('gromver.cmf', 'By publish date'),
            'created_at' => Yii::t('gromver.cmf', 'By create date'),
            'title' => Yii::t('gromver.cmf', 'By name'),
            'ordering' => Yii::t('gromver.cmf', 'By order'),
        ];
    }

    public static function sortDirections()
    {
        return [
            SORT_ASC => Yii::t('gromver.cmf', 'Asc'),
            SORT_DESC => Yii::t('gromver.cmf', 'Desc'),
        ];
    }
}