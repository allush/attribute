<?php

/**
 * This is the model class for table "property".
 *
 * The followings are the available columns in table 'property':
 * @property integer $productID
 * @property integer $propertyID
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Existence[] $existences
 * @property Existence[] $existences1
 * @property Existence[] $existences2
 * @property Product $product
 * @property PropertyItem[] $propertyItems
 */
class Property extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Property the static model class
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
        return 'property';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('productID, name', 'required'),
            array('productID', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('productID, propertyID, name', 'safe', 'on' => 'search'),
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
            'existences' => array(self::HAS_MANY, 'Existence', 'propertyID1'),
            'existences1' => array(self::HAS_MANY, 'Existence', 'propertyID2'),
            'existences2' => array(self::HAS_MANY, 'Existence', 'propertyID3'),
            'product' => array(self::BELONGS_TO, 'Product', 'productID'),
            'propertyItems' => array(self::HAS_MANY, 'PropertyItem', 'propertyID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'productID' => 'Товар',
            'propertyID' => 'Свойство',
            'name' => 'Название',
        );
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

        $criteria->compare('productID', $this->productID);
        $criteria->compare('propertyID', $this->propertyID);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    protected function beforeDelete()
    {
        // удалить все из таблицы наличия у товара, к которому относится свойство
        Existence::model()->deleteAllByAttributes(array(
            'productID' => $this->productID,
        ));

        // удалить значения удаляемого свойства
        PropertyItem::model()->deleteAllByAttributes(array(
            'propertyID' => $this->propertyID,
        ));

        return parent::beforeDelete();
    }
}