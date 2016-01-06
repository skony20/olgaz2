<?php

namespace backend\controllers;

use Yii;
use app\models\UploadForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
/**
 * CategoryController implements the CRUD actions for Category model.
 */
class UploadFormController extends Controller
{

    public function behaviors()
    {
        return [
                'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) 
        {

                $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                if ($model->upload()) 
                {
                    return $this->render('index', ['model' => $model]);
                }
        }

        return $this->render('index');
    }
    
    public function actionAdd()
    {
        $model = new UploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'model' => $model
            ]);
        } else {
            return $this->render('_form', [
                        'model' => $model
            ]);
        }
    }
        public function actionUpdate()
    {
         $model = new UploadForm();

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view']);
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                        'model' => $model
            ]);
        } else {
            return $this->render('_form', [
                        'model' => $model
            ]);
        }
    }
    

}
