<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $userID
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property string $email
 * @property string $password
 * @property integer $activated
 * @property string $lastVisit
 * @property string $createdOn
 * @property string $address
 * @property integer $index
 * @property string $country
 * @property string $phone
 * @property string $region
 * @property string $sity
 *
 * The followings are the available model relations:
 * @property Order[] $orders
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('surname, name, email, password', 'required'),
			array('activated, index', 'numerical', 'integerOnly'=>true),
			array('surname, name, patronymic, email, password, address, country, phone, region, sity', 'length', 'max'=>255),
			array('lastVisit, createdOn', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userID, surname, name, patronymic, email, password, activated, lastVisit, createdOn, address, index, country, phone, region, sity', 'safe', 'on'=>'search'),
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
			'orders' => array(self::HAS_MANY, 'Order', 'userID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userID' => 'User',
			'surname' => 'Фамилия',
			'name' => 'Имя',
			'patronymic' => 'Отчество',
			'email' => 'email',
			'password' => 'Пароль',
			'activated' => 'Активирован',
			'lastVisit' => 'Последнее посещение',
			'createdOn' => 'Создан',
			'address' => 'Адрес',
			'index' => 'Индекс',
			'country' => 'Страна',
			'phone' => 'Телефон',
			'region' => 'Регион/область',
			'sity' => 'Город',
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

		$criteria->compare('userID',$this->userID);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('patronymic',$this->patronymic,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('activated',$this->activated);
		$criteria->compare('lastVisit',$this->lastVisit,true);
		$criteria->compare('createdOn',$this->createdOn,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('index',$this->index);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('sity',$this->sity,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Проверяет пароль пользователя на соответствие введенному в поле
     * @param $password
     * @return bool
     */
    public function validatePassword($password){
        return crypt($password, $this->password) === $this->password;
    }

    /**
     * Создает хэш пароля
     * @param $password
     * @return string
     */
    public function hashPassword($password)
    {
        return crypt($password, $this->generateSalt());
    }

    public function generateSalt(){
        return time();
    }
}