<?php

/**
 * This is the model class for table "catalog".
 *
 * The followings are the available columns in table 'catalog':
 * @property integer $catalogID
 * @property string $name
 * @property integer $parent
 *
 * The followings are the available model relations:
 * @property Product[] $products
 */
class Catalog extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Catalog the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'catalog';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name', 'unique'),
            array('parent', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('catalogID, name, parent', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'products' => array(self::HAS_MANY, 'Product', 'catalogID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'catalogID' => 'ID',
            'name' => 'Название',
            'parent' => 'Родительский каталог',
        );
    }


    protected function beforeDelete()
    {
        Product::model()->updateAll(
            array(
                'catalogID' => null
            ),
            array(
                'condition' => 'catalogID=:catalogID',
                'params' => array(
                    ':catalogID' => $this->catalogID,
                )
            )
        );

        Catalog::model()->updateAll(
            array(
                'parent' => null
            ),
            array(
                'condition' => 'parent=:parent',
                'params' => array(
                    ':parent' => $this->catalogID,
                )
            )
        );

        return parent::beforeDelete();
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('catalogID', $this->catalogID);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('parent', $this->parent);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return Catalog[]
     */
    public function children()
    {
        $children = array();
        if (!$this->isNewRecord) {
            $children = Catalog::model()->findAllByAttributes(array(
                'parent' => $this->catalogID,
            ));
        }
        return $children;
    }

    public static function childrenRecursively(&$catalogIDs, $catalogID)
    {
        $catalogIDs[] = $catalogID;

        /** @var $children Catalog[] */
        $children = Catalog::model()->findAllByAttributes(
            array(
                'parent' => $catalogID,
            )
        );
        foreach ($children as $child) {
            self::childrenRecursively($catalogIDs, $child->catalogID);
        }
    }

    /**
     * @param $mode string 'edit'|another
     * @param $result array
     * @param $parent Catalog|null
     * @return array
     */
    public static function _loadHierarchy(&$result, $parent = null, $mode = 'edit')
    {
        /** @var $catalogs Catalog[] */
        $catalogs = Catalog::model()->findAllByAttributes(
            array(
                'parent' => $parent !== null ? $parent->catalogID : null,
            ),
            array('order' => 'name asc')
        );
        foreach ($catalogs as $catalog) {
            $catalogArr = array();
            if ($mode == 'edit') {
                $catalogArr['text'] = CHtml::link($catalog->name, array("/catalog/update", 'id' => $catalog->catalogID));
            } else {
                $catalogArr['text'] = CHtml::link($catalog->name, array("/product/index", 'c' => $catalog->catalogID));
            }


            // добавляем себя
            $ids = array();
            Catalog::childrenRecursively($ids, $catalog->catalogID);
            $ids = implode(',', $ids);

            // вычислить кол-во ноутовв линейке
            $productCount = Yii::app()->db->createCommand()
                ->select()
                ->from('product')
                ->where('product.catalogID IN (' . $ids . ') AND deleted=0')
                ->query()
                ->rowCount;

            $catalogArr['text'] .= ' <small>(' . $productCount . ')</small>';


            $children = array();
            self::_loadHierarchy($children, $catalog, $mode);
            $catalogArr['children'] = $children;
            $result[] = $catalogArr;
            $children = array();
            unset($children);
        }
    }
}