<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $productID
 * @property string $name
 * @property string $createdOn
 * @property string $modifiedOn
 * @property string $description
 * @property string $unit
 * @property integer $productStatusID
 * @property integer $catalogID
 * @property double $price
 * @property integer $discount
 *
 * The followings are the available model relations:
 * @property Existence[] $existences
 * @property OrderItem[] $orderItems
 * @property Picture[] $pictures
 * @property ProductStatus $productStatus
 * @property Catalog $catalog
 * @property Property[] $properties
 */
class Product extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
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
        return 'product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('productStatusID', 'required'),
            array('productStatusID, catalogID, discount', 'numerical', 'integerOnly' => true),
            array('price', 'numerical'),
            array('name, unit', 'length', 'max' => 255),
            array('createdOn, modifiedOn, description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('productID, name, createdOn, modifiedOn, description, unit, productStatusID, discount', 'safe', 'on' => 'search'),
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
            'existences' => array(self::HAS_MANY, 'Existence', 'productID'),
            'orderItems' => array(self::HAS_MANY, 'OrderItem', 'productID'),
            'pictures' => array(self::HAS_MANY, 'Picture', 'productID'),
            'productStatus' => array(self::BELONGS_TO, 'ProductStatus', 'productStatusID'),
            'catalog' => array(self::BELONGS_TO, 'Catalog', 'catalogID'),
            'properties' => array(self::HAS_MANY, 'Property', 'productID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'productID' => 'ID',
            'name' => 'Название',
            'createdOn' => 'Создан',
            'modifiedOn' => 'Изменен',
            'description' => 'Описание',
            'unit' => 'Ед.изм.',
            'productStatusID' => 'Статус',
            'catalogID' => 'Каталог',
            'discount' => 'Скидка,%',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('createdOn', $this->createdOn, true);
        $criteria->compare('modifiedOn', $this->modifiedOn, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('unit', $this->unit, true);
        $criteria->compare('productStatusID', $this->productStatusID);
        $criteria->compare('discount', $this->discount);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @param int $index
     * @return null|string
     */
    public function image($index = 0)
    {
        if (count($this->pictures) > 0)
            return $this->pictures[$index]->large();

        return null;
    }

    /**
     * @param int $index
     * @return null|string
     */
    public function thumbnail($index = 0)
    {
        if (count($this->pictures) > 0)
            return $this->pictures[$index]->thumbnail();

        return null;
    }


    protected function beforeSave()
    {
        $time = time();
        if ($this->isNewRecord)
            $this->createdOn = $time;
        $this->modifiedOn = $time;

        return parent::beforeSave();
    }
}