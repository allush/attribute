<?php

class ProductController extends FrontController
{

    /**
     * @var $catalogs Catalog[]
     */
    public $catalogs;

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        // обновить кол-во просмотров
        $command = Yii::app()->db->createCommand();
        $command->update(
            'product',
            array(
                'views' => ++$model->views,
            ),
            'productID=:productID',
            array(
                ':productID' => $model->productID,
            )
        );

        $this->pageTitle = 'Каталог - ' . $model->catalog->name . ' - ' . $model->name;

        $relatedProducts = Product::model()->findAll(array(
            'condition' => 'productID<>:productID AND catalogID<>:catalogID AND existence>0 AND deleted=0',
            'params' => array(
                ':productID' => $id,
                ':catalogID' => $model->catalogID
            ),
            'order' => 'RAND()',
            'limit' => 4
        ));

        $similarProducts = Product::model()->findAll(array(
            'condition' => '`group`=:group AND productID<>:productID AND existence>0 AND deleted=0',
            'params' => array(
                ':group' => $model->group,
                ':productID' => $model->productID,
            ),
            'order' => 'productID',
        ));

        $this->render('view', array(
            'model' => $model,
            'relatedProducts' => $relatedProducts,
            'similarProducts' => $similarProducts,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($c = null, $key=null)
    {
        $this->layout = 'catalog';
        $this->pageTitle = 'Каталог';

        $this->catalogs = Catalog::model()->findAll(array(
            'condition' => 'parent IS NULL',
            'order' => 'name ASC'
        ));

        $criteria = new CDbCriteria();

        if ($c !== null and $c != 0) {
            $catalog = Catalog::model()->findByPk($c);
            if ($catalog !== null) {
                $this->pageTitle .= ' - ' . $catalog->name;

                $catalogIDs = array();
                Catalog::childrenRecursively($catalogIDs, $c);
                $criteria->addInCondition('catalogID', $catalogIDs);
                $criteria->addCondition('deleted=0 AND existence>0');
            } else {
                $criteria->condition = 'catalogID IS NOT NULL AND deleted=0 AND existence>0';
            }

        } else {
            $criteria->condition = 'catalogID IS NOT NULL AND deleted=0 AND existence>0';
        }

        if($key !== null && strlen($key) > 0){
            $criteria->addCondition("name LIKE '%" . $key . "%'");
        }

        if (isset($_GET['target'])) {
            if ($_GET['target'] == 'new') {
                // добавленные в течение недели
                $criteria->addCondition('(UNIX_TIMESTAMP()-createdOn)<604800');
            } elseif ($_GET['target'] == 'top') {
                // по убыванию кол-ва просмотров
                $criteria->order = 'views DESC';
            } elseif ($_GET['target'] == 'sale') {
                $criteria->addCondition('discount IS NOT NULL AND discount > 0');
            }
        }

        $dataProvider = new CActiveDataProvider('Product', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 21,
            ),
            'sort' => array(
                'defaultOrder' => 'createdOn DESC'
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'catalogs' => $this->catalogs,
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
}
