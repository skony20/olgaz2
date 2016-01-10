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
        $picture->image = UploadedFile::getInstance($picture, 'image');
        $picture->id = $id;
        $picture->saveImages();

        if ($picture->image !== null ) {

            Yii::$app->response->getHeaders()->set('Vary', 'Accept');
            Yii::$app->response->format = Response::FORMAT_JSON;

            $response = [];

            if ($picture->saveImages(false)) {
                $response['files'][] = [
                    'name' => $picture->image->name,
                    'type' => $picture->image->type,
                    'size' => $picture->image->size,
                    'url' => 'http://localhost/olgaz2/images/'.$id.'/'.$picture->sBig.'/'.$picture->image->name,
                    'thumbnailUrl' => 'http://localhost/olgaz2/images/'.$id.'/'.$picture->sThumb.'/'.$picture->image->name
                ];
                unlink('../../images/'.$id.'/'.$picture->image->name);
            } else {
                $response[] = ['error' => Yii::t('app', 'Unable to save picture')];
            }
            @unlink($picture->image->tempName);
        } else {
            if ($picture->hasErrors(['picture'])) {
                $response[] = ['error' => HtmlHelper::errors($picture)];
            } else {
                throw new HttpException(500, Yii::t('app', 'Could not upload file.'));
            }
        }
        
        return $response;
    }
    

}
