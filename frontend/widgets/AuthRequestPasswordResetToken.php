<?php
/**
 * @link https://github.com/gromver/yii2-cms.git#readme
 * @copyright Copyright (c) Gayazov Roman, 2014
 * @license https://github.com/gromver/yii2-cmf/blob/master/LICENSE
 * @package yii2-cms
 * @version 1.0.0
 */

namespace gromver\cmf\frontend\widgets;

use gromver\cmf\common\widgets\Widget;
use gromver\cmf\common\models\User;

/**
 * Class AuthRequestPasswordResetToken
 * @package yii2-cms
 * @author Gayazov Roman <gromver5@gmail.com>
 */
class AuthRequestPasswordResetToken extends Widget {
    /**
     * @ignore
     * @var User
     */
    public $model;

    public function init()
    {
        parent::init();

        $this->setShowPanel(false);

        if (!isset($this->model)) {
            $this->model = new User();
        }
    }

    protected function launch()
    {
        echo $this->render('auth/requestPasswordResetToken', [
            'model' => $this->model
        ]);
    }
}