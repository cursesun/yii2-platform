<?php
/**
 * @link https://github.com/gromver/yii2-cms.git#readme
 * @copyright Copyright (c) Gayazov Roman, 2014
 * @license https://github.com/gromver/yii2-cmf/blob/master/LICENSE
 * @package yii2-cms
 * @version 1.0.0
 */

namespace gromver\cmf\backend\modules\news;

use gromver\cmf\backend\interfaces\DesktopInterface;
use gromver\cmf\backend\interfaces\MenuRouterInterface;
use Yii;

/**
 * Class Module
 * @package yii2-cms
 * @author Gayazov Roman <gromver5@gmail.com>
 */
class Module extends \yii\base\Module implements MenuRouterInterface, DesktopInterface
{
    public $controllerNamespace = 'gromver\cmf\backend\modules\news\controllers';
    public $defaultRoute = 'category';
    public $desktopOrder = 4;

    /*public function init()
    {
        parent::init();

        // custom initialization code goes here
    }*/

    /**
     * @inheritdoc
     */
    public function getDesktopItem()
    {
        return [
            'label' => Yii::t('menst.cms', 'News'),
            'links' => [
                ['label' => Yii::t('menst.cms', 'Categories'), 'url' => ['/cmf/news/category']],
                ['label' => Yii::t('menst.cms', 'Posts'), 'url' => ['/cmf/news/post']],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function getMenuRoutes()
    {
        return [
            'label' => Yii::t('menst.cms', 'News'),
            'routers' => [
                ['label' => Yii::t('menst.cms', 'Post View'), 'url' => ['/cmf/news/post/select']],
                ['label' => Yii::t('menst.cms', 'Category View'), 'url' => ['/cmf/news/category/select']],
                ['label' => Yii::t('menst.cms', 'All Posts'), 'route' => 'cmf/news/post/index'],
            ]
        ];
    }
}
