<?php

class ProductController extends BackendController
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete, deletePicture', // we only allow deletion via POST request
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

    public function actionSetWatermarkAndThumbnail()
    {
        set_time_limit(0);

        /** @var Product[] $products */
        $products = Product::model()->findAll();
        foreach ($products as $product) {
            foreach ($product->pictures as $picture) {
                $picture->setWatermark();
                $picture->createThumbnail();
            }
        }
    }

    /**
     * @return bool
     */

    public function actionGroupAction()
    {
        if (!isset($_POST['action']) || !isset($_POST['productID'])) {
            $this->redirect(Yii::app()->request->urlReferrer);
        }

        switch ($_POST['action']) {
            case 'group':
                $this->group($_POST['productID']);
                break;

            case 'ungroup':
                $this->ungroup($_POST['productID']);
                break;
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    private function group($productIDs)
    {
        if (!is_array($productIDs) or count($productIDs) < 2) {
            return;
        }

        $command = Yii::app()->db->createCommand();
        $groupNumber = $command->select('MAX(`group`)')
            ->from('product')
            ->queryScalar();

        if ($groupNumber === null) {
            $groupNumber = 0;
        }
        $groupNumber++;

        foreach ($productIDs as $productID) {
            $product = Product::model()->findByPk($productID);
            $product->group = $groupNumber;
            $product->save();
        }
    }

    private function ungroup($productIDs)
    {
        if (!is_array($productIDs) or count($productIDs) == 0) {
            return;
        }

        foreach ($productIDs as $productID) {
            $product = Product::model()->findByPk($productID);
            $product->group = null;
            $product->save();
        }
    }

    public function actionUpload()
    {
        /** @var $files CUploadedFile[] */
        $files = CUploadedFile::getInstancesByName('file');
        foreach ($files as $file) {

            // создать продукт
            $product = new Product();
            $product->productStatusID = 1;

            // если продукт успешно сохранен
            if ($product->save()) {
                // преобразовать имя файла в уникальное, сохраняя расширение файла
                $originalFilename = $file->getName();
                $fileExtension = strtolower(substr($originalFilename, strripos($originalFilename, '.')));
                $filename = md5(crypt($originalFilename)) . $fileExtension;

                // определение пути сохранения файлов
                $pathLarge = 'img/product/large/' . $filename;

                // если большое изображение успешно сохранено
                if ($file->saveAs($pathLarge)) {
                    // создать модель фото продукта
                    $picture = new Picture();
                    $picture->productID = $product->productID;
                    $picture->filename = $filename;
                    $picture->save();

                    $picture->setWatermark();

                    $picture->createThumbnail();
                }
            } else {
                return false;
            }
        }
    }


    public function actionDeletePicture($productPictureID)
    {
        /** @var $picture Picture */
        $picture = Picture::model()->findByPk($productPictureID);

        $base = Yii::app()->basePath . '/..';
        @unlink($base . $picture->large());
        @unlink($base . $picture->thumbnail());
        @unlink($base . $picture->watermark());

        $picture->delete();

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * Добавление фото к товару
     * @param $productID
     */
    public function actionUploadPicture($productID)
    {
        /** @var $files CUploadedFile[] */
        $files = CUploadedFile::getInstancesByName('file');
        foreach ($files as $file) {

            // преобразовать имя файла в уникальное, сохраняя расширение файла
            $originalFilename = $file->getName();
            $fileExtension = strtolower(substr($originalFilename, strripos($originalFilename, '.')));
            $filename = md5(crypt($originalFilename)) . $fileExtension;

            // определение пути сохранения файлов
            $pathLarge = 'img/product/large/' . $filename;
            $pathThumbnail = 'img/product/thumbnail/' . $filename;

            // если большое изображение успешно сохранено
            if ($file->saveAs($pathLarge)) {

                // создать модель фото продукта
                $picture = new Picture();
                $picture->productID = $productID;
                $picture->filename = $filename;
                $picture->save();

                $picture->setWatermark();

                $picture->createThumbnail();

            }
        }
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
    public function actionCreate()
    {
        $model = new Product;

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->productID));
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    Yii::app()->end();
                }
                $this->redirect(array('view', 'id' => $model->productID));
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
        $model = $this->loadModel($id);
        $catalogID = $model->catalogID;
//        $model->delete();

        $model->deleted = true;
        $model->save();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index', 'c' => $catalogID));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($c = null, $key = null)
    {
        $hierarchy = array();
        Catalog::_loadHierarchy($hierarchy, null, 'view');

        $criteria = new CDbCriteria();
        $criteria->condition = 'catalogID IS NOT NULL AND deleted=0';

        if ($c !== null) {
            if ($c == 0) {
                $criteria->condition = 'catalogID IS NULL AND deleted=0';
            } else {
                $catalogIDs = array();
                Catalog::childrenRecursively($catalogIDs, $c);
                $criteria->addInCondition('catalogID', $catalogIDs);
            }
        }

        if ($key !== null and strlen($key) > 0) {
            $criteria->addCondition("name LIKE '" . $key . "%' OR productNumber LIKE '" . $key . "%'");
        }

        $dataProvider = new CActiveDataProvider('Product', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50,
            ),
            'sort' => array(
                'defaultOrder' => '`group` DESC, modifiedOn DESC'
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'hierarchy' => $hierarchy,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        /** @var $model Product */
        $model = Product::model()->findByPk($id);
        if ($model === null || $model->deleted)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Product $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
