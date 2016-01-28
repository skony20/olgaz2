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
use yii\web\HttpException;
use yii\web\Response;
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
    public function actionUpload($id)
    {
        $picture = new UploadForm();
        //$picture->tour_id = $id;
        $picture->image = UploadedFile::getInstancesByName('attachment_'.$id.'');
        //echo '<pre> File2: ' . print_r( $picture->image, TRUE). '</pre>'; die();
        $picture->id = $id;
        $picture->saveImages();
        
       return true;
    }
    

}
