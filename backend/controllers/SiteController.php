<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\PermisosHelpers;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
{
   return [
        
    'access' => [
           'class' => \yii\filters\AccessControl::className(),
           'only' => ['index', 'view','create', 'update', 'delete'],
           'rules' => [
               [
                   'actions' => ['index', 'create', 'view',],
                   'allow' => true,
                   'roles' => ['@'],
                   'matchCallback' => function ($rule, $action) {
                    return PermisosHelpers::requerirMinimoRol('Admin') 
                    && PermisosHelpers::requerirEstado('Activo');
                   }
               ],
                [
                   'actions' => [ 'update', 'delete'],
                   'allow' => true,
                   'roles' => ['@'],
                   'matchCallback' => function ($rule, $action) {
                    return PermisosHelpers::requerirMinimoRol('SuperUsuario') 
                    && PermisosHelpers::requerirEstado('Activo');
                   }
               ],
                    
           ],
                
       ],

    
      'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
}

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        if (!\Yii::$app->user->isGuest) { 
                return $this->goHome(); 
            }
        $model = new LoginForm(); 
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) { 
                return $this->goBack(); 
        } else { 
            return $this->render('login', [ 
                'model' => $model, 
            ]); 
    }

}

}
