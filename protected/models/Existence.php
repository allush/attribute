<?php

/**
 * This is the model class for table "existence".
 *
 * The followings are the available columns in table 'existence':
 * @property integer $existenceID
 * @property integer $productID
 * @property integer $quantity
 * @property integer $propertyItemID1
 * @property integer $propertyItemID2
 * @property integer $propertyItemID3
 * @property integer $propertyID1
 * @property integer $propertyID2
 * @property integer $propertyID3
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property PropertyItem $propertyItemID10
 * @property PropertyItem $propertyItemID20
 * @property PropertyItem $propertyItemID30
 * @property Property $propertyID10
 * @property Property $propertyID20
 * @property Property $propertyID30
 * @property OrderItem[] $orderitems
 */
class Existence extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Existence the static model class
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
		return 'existence';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('productID, quantity, propertyItemID1, propertyItemID2, propertyItemID3, propertyID1, propertyID2, propertyID3', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('existenceID, productID, quantity, propertyItemID1, propertyItemID2, propertyItemID3, propertyID1, propertyID2, propertyID3', 'safe', 'on'=>'search'),
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
			'propertyItemID10' => array(self::BELONGS_TO, 'PropertyItem', 'propertyItemID1'),
			'propertyItemID20' => array(self::BELONGS_TO, 'PropertyItem', 'propertyItemID2'),
			'propertyItemID30' => array(self::BELONGS_TO, 'PropertyItem', 'propertyItemID3'),
			'propertyID10' => array(self::BELONGS_TO, 'Property', 'propertyID1'),
			'propertyID20' => array(self::BELONGS_TO, 'Property', 'propertyID2'),
			'propertyID30' => array(self::BELONGS_TO, 'Property', 'propertyID3'),
			'orderitems' => array(self::HAS_MANY, 'OrderItem', 'existenceID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'existenceID' => 'Existence',
			'productID' => 'Product',
			'quantity' => 'Quantity',
			'propertyItemID1' => 'Property Item Id1',
			'propertyItemID2' => 'Property Item Id2',
			'propertyItemID3' => 'Property Item Id3',
			'propertyID1' => 'Property Id1',
			'propertyID2' => 'Property Id2',
			'propertyID3' => 'Property Id3',
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

		$criteria->compare('existenceID',$this->existenceID);
		$criteria->compare('productID',$this->productID);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('propertyItemID1',$this->propertyItemID1);
		$criteria->compare('propertyItemID2',$this->propertyItemID2);
		$criteria->compare('propertyItemID3',$this->propertyItemID3);
		$criteria->compare('propertyID1',$this->propertyID1);
		$criteria->compare('propertyID2',$this->propertyID2);
		$criteria->compare('propertyID3',$this->propertyID3);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}