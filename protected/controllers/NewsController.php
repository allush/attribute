<?php

class NewsController extends FrontController
{

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $model->numViews++;
        $model->save();

        $this->pageTitle = 'Новости - ' . $model->header;

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $popularNews = new CActiveDataProvider('News',array(
            'criteria'=>array(
                'order'=>'numViews DESC, newsID DESC',
                'limit' => 5
            ),
            'pagination'=>false
        ));

        $dataProvider = new CActiveDataProvider('News',array(
            'criteria'=>array(
                'order'=>'newsID DESC',
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'popularNews' => $popularNews
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return News the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = News::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
