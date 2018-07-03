<?php

namespace app\controllers;

use app\models\CommentForm;
use app\models\Comments;
use app\models\PicturesForm;
use app\models\User;
use app\services\PictureRating;
use Yii;
use app\models\Pictures;
use app\models\PicturesSearch;
use yii\base\Module;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PictureController implements the CRUD actions for Pictures model.
 */
class PictureController extends Controller
{
    private $pictureRating;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function __construct(string $id, Module $module,PictureRating $pictureRating, array $config = [])
    {
        $this->pictureRating = $pictureRating;
        parent::__construct($id, $module, $config);
    }

    /**
     * Lists all Pictures models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Pictures::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'pictureRating' =>  $this->pictureRating
        ]);
    }
    public function actionAwaiting()
    {
        $query = Pictures::find()->where(['status' => 0])->orderBy(['id' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'pictureRating' =>  $this->pictureRating
        ]);
    }

    public function actionTop()
    {
        $query = Pictures::find()
            ->select(["*", "(SELECT SUM(rate) as total_rate FROM rating WHERE rating.picture_id = pictures.id) as points"])
            ->where(['status' => 1])
            ->orderBy(['points' => SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'pictureRating' =>  $this->pictureRating
        ]);
    }
    /**
     * Displays a single Pictures model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $commentForm = new CommentForm();
        $commentForm->picture_id = $id;
        $commentForm->parent_id = 0;


        return $this->render('view', [
            'model' => $this->findModel($id),
            'comment' => $commentForm,
            'pictureRating' =>  $this->pictureRating
        ]);
    }

    /**
     * Creates a new Pictures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PicturesForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $pictureID = $model->save();

            return $this->redirect(['view', 'id' => $pictureID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionRandom()
    {
        $model = Pictures::find()->orderBy('RAND()')->one();
        return $this->redirect(['view','id' => $model->id]);

    }

    public function actionSearch(){
        $phrase = Yii::$app->request->get('phrase');
        $query = Pictures::find()
            ->select(["*", "(SELECT SUM(rate) as total_rate FROM rating WHERE rating.picture_id = pictures.id) as points"])
            ->where(['status' => 1])
            ->andFilterWhere(['like', 'name', $phrase])
            ->orderBy(['points' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('search', [
            'models' => $models,
            'phrase' => $phrase,
            'pages' => $pages,
            'pictureRating' =>  $this->pictureRating
        ]);

    }

    public function actionUser($id){

        $user = User::find()->where(['id' => $id])->one();
        if (!$user){
            throw new HttpException(404, 'User not found');
        }
        $query = Pictures::find()
            ->select(["*", "(SELECT SUM(rate) as total_rate FROM rating WHERE rating.picture_id = pictures.id) as points"])
            ->where(['status' => 1])
            ->andWhere(['author_id' => $user->id])
            ->orderBy(['points' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 5]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('user', [
            'models' => $models,
            'user' => $user,
            'pages' => $pages,
            'pictureRating' =>  $this->pictureRating
        ]);

    }
    /**
     * Finds the Pictures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pictures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pictures::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
