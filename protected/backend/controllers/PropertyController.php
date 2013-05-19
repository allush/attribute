<?php

class PropertyController extends Controller
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($productID)
    {
        $model = new Property;

        if (isset($_POST['Property'])) {
            $model->attributes = $_POST['Property'];
            if ($model->save()) {
                $this->redirect(array('/product/view', 'id' => $model->productID));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'productID' => $productID,
        ));
    }

    /**
     * @param $id
     * @param $productID
     */
    public function actionUpdate($id, $productID)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Property'])) {
            $model->attributes = $_POST['Property'];
            if ($model->save()) {
                $this->redirect(array('/product/view', 'id' => $model->productID));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'productID' => $productID,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $productID = $model->productID;

        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])){
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/product/view', 'id' => $productID));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Property');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Property('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Property']))
            $model->attributes = $_GET['Property'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Property the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Property::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Property $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'property-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
