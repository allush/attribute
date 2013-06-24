<?php

class ProductController extends Controller
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
        $relatedProducts = Product::model()->findAll(array(
            'condition' => 'productID<>:productID',
            'params' => array(
                ':productID' => $id,
            ),
            'order' => 'productID',
            'limit' => 4
        ));

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'relatedProducts' => $relatedProducts,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($c = null)
    {
        $this->layout = 'catalog';

        $this->catalogs = Catalog::model()->findAll('parent IS NULL');

        $criteria = new CDbCriteria();
        $criteria->condition = 'catalogID IS NOT NULL';

        if ($c !== null) {
            if ($c == 0) {
                $criteria->condition = 'catalogID IS NULL';
            } else {
                $catalogIDs = array();
                Catalog::childrenRecursively($catalogIDs, $c);
                $criteria->addInCondition('catalogID', $catalogIDs);
            }
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
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
