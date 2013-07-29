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

        $this->pageTitle = 'Каталог - ' . $model->catalog->name . ' - ' . $model->name;

        $relatedProducts = Product::model()->findAll(array(
            'condition' => 'productID<>:productID',
            'params' => array(
                ':productID' => $id,
            ),
            'order' => 'productID',
            'limit' => 4
        ));

        $similarProducts = Product::model()->findAll(array(
            'condition' => '`group`=:group AND productID<>:productID',
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
    public function actionIndex($c = null)
    {
        $this->layout = 'catalog';
        $this->pageTitle = 'Каталог';

        $this->catalogs = Catalog::model()->findAll('parent IS NULL');

        $criteria = new CDbCriteria();

        if ($c !== null and $c !== 0) {
            $catalog = Catalog::model()->findByPk($c);
            if ($catalog !== null) {
                $this->pageTitle .= ' - ' . $catalog->name;
            }

            $catalogIDs = array();
            Catalog::childrenRecursively($catalogIDs, $c);
            $criteria->addInCondition('catalogID', $catalogIDs);
            $criteria->addCondition('deleted=0');
        } else {
            $criteria->condition = 'catalogID IS NOT NULL AND deleted=0';
        }

        $dataProvider = new CActiveDataProvider('Product', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 12,
            ),
            'sort' => array(
                'defaultOrder' => 'modifiedOn DESC'
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
