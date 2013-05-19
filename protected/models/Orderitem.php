<?php

/**
 * This is the model class for table "orderitem".
 *
 * The followings are the available columns in table 'orderitem':
 * @property integer $orderItemID
 * @property integer $productID
 * @property integer $quantity
 * @property integer $orderID
 * @property integer $existenceID
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Order $order
 * @property Existence $existence
 */
class OrderItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderItem the static model class
	 */
	public static function model($className=__CLASS__)
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
			array('productID, quantity, orderID, existenceID', 'required'),
			array('productID, quantity, orderID, existenceID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('orderItemID, productID, quantity, orderID, existenceID', 'safe', 'on'=>'search'),
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
			'existence' => array(self::BELONGS_TO, 'Existence', 'existenceID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderItemID' => 'Order Item',
			'productID' => 'Product',
			'quantity' => 'Quantity',
			'orderID' => 'Order',
			'existenceID' => 'Existence',
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

		$criteria=new CDbCriteria;

		$criteria->compare('orderItemID',$this->orderItemID);
		$criteria->compare('productID',$this->productID);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('orderID',$this->orderID);
		$criteria->compare('existenceID',$this->existenceID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}