<?php
/**
 * @link https://github.com/gromver/yii2-cmf.git#readme
 * @copyright Copyright (c) Gayazov Roman, 2014
 * @license https://github.com/gromver/yii2-grom/blob/master/LICENSE
 * @package yii2-cmf
 * @version 1.0.0
 */

namespace gromver\platform\backend\interfaces;

/**
 * Interface MenuRouterInterface
 * @package yii2-cmf
 * @author Gayazov Roman <gromver5@gmail.com>
 */
interface MenuRouterInterface
{
    /**
     * @return array
     * @see \gromver\platform\backend\widgets\Routers
     */
    public function getMenuRoutes();
}