<?php

namespace app\modules\BearerApi\controllers;

use app\models\LoginForm;
use http\Env\Response;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\Controller;

/**
 * Default controller for the `bearer-api` module
 */
class DefaultController extends Controller
{/*
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpBasicAuth::className();
        $behaviors['authenticator']['auth'] = function ($username, $password) {
            return \app\models\User::findOne(
                    [
                            'username' => $username,
                            'password' => $password,
                    ]
            );
        };
        return $behaviors;
    }
*/


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        die("ds");
        return $this->render('index');
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionView($id)
    {
        die("dss");
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        die("ds");
        if (!Yii::$app->user->isGuest) {
            //    return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            /*  return $this->redirect(['post/index']);*/
        }
        $model->password = '';

    }
}
