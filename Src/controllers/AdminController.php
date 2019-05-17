<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\db\StaleObjectException;
use \Throwable;

class AdminController extends Controller {

      public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
      
    public function actionCreate() {
        $model = new User();
        $role = Yii::$app->request->post()['User']['roleName'] ?? null;

        if ($model->load(Yii::$app->request->post())) {
            $model->password = password_hash($model->password, PASSWORD_BCRYPT);
            if ($model->save()) {
                $model->assignNewRole($role);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
      
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $role = Yii::$app->request->post()['User']['roleName'] ?? null;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $model->assignNewRole($role);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
      
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
      
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
