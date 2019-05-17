<?php

namespace app\controllers;

use thamtech\uuid\helpers\UuidHelper;
use Throwable;
use Yii;
use app\models\CardPair;
use app\models\CardPairSearch;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class CardPairController extends Controller {

      public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['teacher'],
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
        $searchModel = new CardPairSearch();
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
        $model = new CardPair();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
      
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        if (($model = CardPair::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
      
    public function actionUpload() {
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp');
        $path = Yii::$app->basePath . '/web/uploads/';
        if ($_FILES['image']) {

            $img = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];

            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $uuid = UuidHelper::uuid();
            $final_image = $uuid . '.' . $ext;

            if (in_array($ext, $valid_extensions)) {
                $path = $path . strtolower($final_image);
                if (move_uploaded_file($tmp, $path)) {
                    return $final_image;
                }
            } else {
                return 'invalid';
            }
        }
    }
}
