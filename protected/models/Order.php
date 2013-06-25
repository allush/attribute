<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $orderID
 * @property integer $orderStatusID
 * @property string $createdOn
 * @property string $modifiedOn
 * @property integer $orderPaymentID
 * @property integer $orderDeliveryID
 * @property integer $userID
 * @property string $comment
 * @property string $sessid
 *
 * The followings are the available model relations:
 * @property OrderStatus $orderStatus
 * @property OrderPayment $orderPayment
 * @property OrderDelivery $orderDelivery
 * @property User $user
 * @property OrderItem[] $orderItems
 */
class Order extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Order the static model class
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
            array('sessid', 'required'),
            array('orderStatusID, orderPaymentID, orderDeliveryID, userID', 'numerical', 'integerOnly' => true),
            array('createdOn, modifiedOn, comment', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('orderID, orderStatusID, createdOn, modifiedOn, orderPaymentID, orderDeliveryID, userID, comment', 'safe', 'on' => 'search'),
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
            'orderStatus' => array(self::BELONGS_TO, 'OrderStatus', 'orderStatusID'),
            'orderPayment' => array(self::BELONGS_TO, 'OrderPayment', 'orderPaymentID'),
            'orderDelivery' => array(self::BELONGS_TO, 'OrderDelivery', 'orderDeliveryID'),
            'user' => array(self::BELONGS_TO, 'User', 'userID'),
            'orderItems' => array(self::HAS_MANY, 'OrderItem', 'orderID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'orderID' => '#',
            'orderStatusID' => 'Статус',
            'createdOn' => 'Создан',
            'modifiedOn' => 'Изменен/Завершен',
            'orderPaymentID' => 'Оплата',
            'orderDeliveryID' => 'Доставка',
            'userID' => 'Пользователь',
            'comment' => 'Комментарий',
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

        $criteria->compare('orderID', $this->orderID);
        $criteria->compare('orderStatusID', $this->orderStatusID);
        $criteria->compare('createdOn', $this->createdOn, true);
        $criteria->compare('modifiedOn', $this->modifiedOn, true);
        $criteria->compare('orderPaymentID', $this->orderPaymentID);
        $criteria->compare('orderDeliveryID', $this->orderDeliveryID);
        $criteria->compare('userID', $this->userID);
        $criteria->compare('comment', $this->comment, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
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
     * Возвращает сумму товара в заказе
     */
    public function sum()
    {
        $command = Yii::app()->db->createCommand();
        $sum = $command->select('SUM(product.price*quantity)')
            ->from('orderitem')
            ->join('product', 'product.productID=orderItem.productID')
            ->where('orderID=:orderID', array(':orderID' => $this->orderID))
            ->queryScalar();
        return $sum;
    }
}