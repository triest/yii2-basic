<?php

namespace app\modules\BearerApi;

use Yii;
use yii\web\Response;

/**
 * bearer-api module definition class
 */
class BearerApi extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\BearerApi\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
  //      Yii::$app->response->format = Response::FORMAT_JSON;
        // custom initialization code goes here
    }
}
