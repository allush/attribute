<?php

/**
 * This is the model class for table "orderitem".
 *
 * The followings are the available columns in table 'orderitem':
 * @property integer $orderItemID
 * @property integer $productID
 * @property integer $quantity
 * @property integer $orderID
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Order $order
 */
class OrderItem extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return OrderItem the static model class
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
        return 'orderitem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('productID, quantity, orderID', 'required'),
            array('productID, quantity, orderID', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('orderItemID, productID, quantity, orderID', 'safe', 'on' => 'search'),
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
            'product' => array(self::BELONGS_TO, 'Product', 'productID'),
            'order' => array(self::BELONGS_TO, 'Order', 'orderID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'orderItemID' => '#',
            'productID' => 'Товар',
            'quantity' => 'Количество',
            'orderID' => 'Номер заказа',
        );
    }
}