<?php

class PropertyItemController extends Controller
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($propertyID)
    {
        /** @var $property Property */
        $property = Property::model()->findByPk($propertyID);
        $model = new PropertyItem;

        if (isset($_POST['PropertyItem'])) {
            $model->attributes = $_POST['PropertyItem'];
            if ($model->save()) {
                $this->redirect(array('/product/view', 'id' => $property->productID));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'propertyID' => $propertyID,
        ));
    }

    /**
     * @param $id
     * @param $propertyID
     */
    public function actionUpdate($id, $propertyID)
    {
        /** @var $property Property */
        $property = Property::model()->findByPk($propertyID);

        $model = $this->loadModel($id);

        if (isset($_POST['PropertyItem'])) {
            $model->attributes = $_POST['PropertyItem'];
            if ($model->save()) {
                $this->redirect(array('/product/view', 'id' => $property->productID));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'propertyID' => $propertyID,
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
        $productID = $model->property->productID;

        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/product/view', 'id' => $productID));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('PropertyItem');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new PropertyItem('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['PropertyItem']))
            $model->attributes = $_GET['PropertyItem'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PropertyItem the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = PropertyItem::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PropertyItem $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'property-item-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
