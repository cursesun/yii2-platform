<?php
/**
 * @link https://github.com/gromver/yii2-cms.git#readme
 * @copyright Copyright (c) Gayazov Roman, 2014
 * @license https://github.com/gromver/yii2-cmf/blob/master/LICENSE
 * @package yii2-cms
 * @version 1.0.0
 */

namespace gromver\cmf\backend\modules\menu;

use gromver\cmf\backend\interfaces\DesktopInterface;
use Yii;

/**
 * Class Module
 * @package yii2-cms
 * @author Gayazov Roman <gromver5@gmail.com>
 */
class Module extends \yii\base\Module implements DesktopInterface
{
    public $controllerNamespace = 'gromver\cmf\backend\modules\menu\controllers';
    public $defaultRoute = 'item';
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
            'label' => Yii::t('menst.cms', 'Menu'),
            'links' => [
                ['label' => Yii::t('menst.cms', 'Menu Types'), 'url' => ['/cmf/menu/type']],
                ['label' => Yii::t('menst.cms', 'Menu Items'), 'url' => ['/cmf/menu/item']],
            ]
        ];
    }
}
