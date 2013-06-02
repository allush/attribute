<?php

class ActionController extends Controller
{

    public function actionView($id){
        $model = $this->loadModel($id);
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Action');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Action the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Action::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
