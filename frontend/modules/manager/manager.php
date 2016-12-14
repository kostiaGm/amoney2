<?php

namespace frontend\modules\manager;

/**
 * manager module definition class
 */
class manager extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\manager\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->layout = 'manager';
        parent::init();

        // custom initialization code goes here
    }
}
