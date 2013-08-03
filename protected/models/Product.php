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
 * @property float $price
 * @property float $purchase
 * @property integer $discount
 * @property integer $existence
 * @property integer $productNumber
 * @property integer $deleted
 * @property integer $group
 * @property integer $views
 *
 * The followings are the available model relations:
 * @property OrderItem[] $orderItems
 * @property Picture[] $pictures
 * @property ProductStatus $productStatus
 * @property Catalog $catalog
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
            array('productStatusID, group, catalogID, discount, createdOn, modifiedOn', 'numerical', 'integerOnly' => true),
            array('deleted', 'boolean'),
            array('price, existence, purchase', 'numerical'),
            array('name, unit, productNumber', 'length', 'max' => 255),
            array('description', 'safe'),
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
            'orderItems' => array(self::HAS_MANY, 'OrderItem', 'productID'),
            'pictures' => array(self::HAS_MANY, 'Picture', 'productID'),
            'productStatus' => array(self::BELONGS_TO, 'ProductStatus', 'productStatusID'),
            'catalog' => array(self::BELONGS_TO, 'Catalog', 'catalogID'),
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
            'price' => 'Цена,р',
            'purchase' => 'Закупка,р',
            'existence' => 'Наличие',
            'productNumber' => 'Артикул',
            'group' => 'Группа',
            'views' => 'Количество просмотров'
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
        $criteria->compare('existence', $this->existence);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @param int $index
     * @return null|string
     */
    public function large($index = 0)
    {
        if (count($this->pictures) > 0) {
            return $this->pictures[$index]->large();
        }

        return null;
    }

    /**
     * @param int $index
     * @return null|string
     */
    public function watermark($index = 0)
    {
        if (count($this->pictures) > 0) {
            return $this->pictures[$index]->watermark();
        }

        return null;
    }

    /**
     * @param int $index
     * @return null|string
     */
    public function thumbnail($index = 0)
    {
        if (count($this->pictures) > 0){
            return $this->pictures[$index]->thumbnail();
        }

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

    /**
     * Стоимость вместе с валютой
     * @return string
     */
    public function priceCurrency()
    {
        return $this->price() . ' руб.';

    }

    public function price()
    {
        $price = $this->price;

        if ($this->discount !== null && $this->discount > 0) {
            $price = round($this->price - ($this->price * $this->discount / 100));
        }
        return $price;
    }
}