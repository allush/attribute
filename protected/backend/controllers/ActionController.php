<?php

class ActionController extends BackendController
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
    public function actionCreate()
    {
        $model = new Action;

        if (isset($_POST['Action'])) {
            $model->attributes = $_POST['Action'];

            $pictureFile = CUploadedFile::getInstanceByName('Action[picture]');
            $filename = '';
            if ($pictureFile !== null) {
                $originalFilename = $pictureFile->getName();
                $fileExtension = strtolower(substr($originalFilename, strripos($originalFilename, '.')));
                $filename = md5(crypt($originalFilename)) . $fileExtension;
            }
            $model->picture = $filename;

            if ($model->save()) {
                $path = $model->picturePath . $filename;
                if ($pictureFile !== null && $pictureFile->saveAs($path)) {
                    $ih = new CImageHandler();
                    $ih->load($path);
                    $ih->thumb(false, 279)->save();
                }
                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Action'])) {
            $pictureFile = CUploadedFile::getInstanceByName('Action[picture]');

            $filename = $model->picture;
            if ($pictureFile !== null) {
                $model->deletePicture();

                $originalFilename = $pictureFile->getName();
                $fileExtension = strtolower(substr($originalFilename, strripos($originalFilename, '.')));
                $filename = md5(crypt($originalFilename)) . $fileExtension;
            }

            $_POST['Action']['picture'] = $filename;

            $model->attributes = $_POST['Action'];

            if ($model->save()) {
                $path = $model->picturePath . $filename;
                if ($pictureFile !== null && $pictureFile->saveAs($path)) {
                    $ih = new CImageHandler();
                    $ih->load($path);
                    $ih->thumb(false, 279)->save();
                }
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
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
