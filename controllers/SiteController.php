<?php

namespace app\controllers;

use app\services\PrizeService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'result', 'refuse', 'moneyToLoyalty', 'sendMoneyToAccount'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * The button action.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->request->post('getPrize', false)) {
            (new PrizeService())->generate(); // TODO: generate() method didn't tested for workability yet
            Yii::$app->session->setFlash('result', 'You are win!');

            return $this->redirect(['result']);
        }

        return $this->render('index');
    }

    /**
     * Win results page
     *
     * @return mixed
     */
    public function actionResult($id) // TODO: $id - the ID of UserPrize Model
    {
        // TODO: Render correct view

        return $this->render('result');
    }

    /**
     * Refuse the prize
     *
     * @return mixed
     */
    public function actionRefuse($id) // TODO: $id - the ID of UserPrize Model
    {
        (new PrizeService())->refuse($id); // TODO: refuse() method not implemented yet
        Yii::$app->session->setFlash('result', 'You has been refused your prize');

        return $this->goBack();
    }

    /**
     * Exchange money to User's loyalty points
     *
     * @return mixed
     */
    public function actionMoneyToLoyalty()
    {
        // TODO: Money to Loyalty

        Yii::$app->session->setFlash('result', 'Money was exchanged to your loyalty points');

        return $this->goBack();
    }

    /**
     * Send money to User's account
     *
     * @return mixed
     */
    public function actionSendMoneyToAccount()
    {
        // TODO: Send money

        Yii::$app->session->setFlash('result', 'Money was sent to your account');

        return $this->goBack();
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
