<?php

namespace backend\controllers;

use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\BaseUrl;
use yii\helpers\Url;
use yii\data\Pagination;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Post::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy('id DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();

         $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $model->user_id = $userId = \Yii::$app->user->identity->id;
            if ($model->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        elseif (Yii::$app->request->isAjax) 
        {
            return $this->renderAjax('_form', [
                        'model' => $model
            ]);
        } 
        else 
        {
            return $this->render('_form', [
                        'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Strona nie istnieje.');
        }
    }
    public function actionDeleteimages($folder, $file) 
    {
        $model = new Post();  
        unlink($model->sPath . '' .$folder.'/' .$model->sBig.'/'.$file);
        unlink($model->sPath . '' .$folder.'/' .$model->sInfo.'/'.$file);
        unlink($model->sPath . '' .$folder.'/' .$model->sThumb.'/'.$file);
        return $this->redirect(Yii::$app->request->referrer);
    }
    public function actionActiveunactive($id, $p_sActive)
    {
        $bActive = ($p_sActive == 'active' ? 0 : 1);
        $model = $this->findModel($id);
        $model->is_active = $bActive;
        if ($model->save())
        {
             return $this->redirect(Yii::$app->request->referrer);
        }
        return FALSE;
    }

}
