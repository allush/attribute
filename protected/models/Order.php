<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $orderID
 * @property integer $orderStatusID
 * @property string $createdOn
 * @property string $completedOn
 * @property string $executedOn
 * @property integer $orderPaymentID
 * @property integer $orderDeliveryID
 * @property integer $userID
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Orderstatus $orderStatus
 * @property Orderpayment $orderPayment
 * @property Orderdelivery $orderDelivery
 * @property User $user
 * @property Orderitem[] $orderitems
 */
class Order extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Order the static model class
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
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderStatusID, orderPaymentID, orderDeliveryID, userID', 'required'),
			array('orderStatusID, orderPaymentID, orderDeliveryID, userID', 'numerical', 'integerOnly'=>true),
			array('createdOn, completedOn, executedOn, comment', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('orderID, orderStatusID, createdOn, completedOn, executedOn, orderPaymentID, orderDeliveryID, userID, comment', 'safe', 'on'=>'search'),
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
			'orderStatus' => array(self::BELONGS_TO, 'Orderstatus', 'orderStatusID'),
			'orderPayment' => array(self::BELONGS_TO, 'Orderpayment', 'orderPaymentID'),
			'orderDelivery' => array(self::BELONGS_TO, 'Orderdelivery', 'orderDeliveryID'),
			'user' => array(self::BELONGS_TO, 'User', 'userID'),
			'orderitems' => array(self::HAS_MANY, 'Orderitem', 'orderID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'orderID' => 'Order',
			'orderStatusID' => 'Order Status',
			'createdOn' => 'Created On',
			'completedOn' => 'Completed On',
			'executedOn' => 'Executed On',
			'orderPaymentID' => 'Order Payment',
			'orderDeliveryID' => 'Order Delivery',
			'userID' => 'User',
			'comment' => 'Comment',
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

		$criteria->compare('orderID',$this->orderID);
		$criteria->compare('orderStatusID',$this->orderStatusID);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('completedOn',$this->completedOn,true);
		$criteria->compare('executedOn',$this->executedOn,true);
		$criteria->compare('orderPaymentID',$this->orderPaymentID);
		$criteria->compare('orderDeliveryID',$this->orderDeliveryID);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}