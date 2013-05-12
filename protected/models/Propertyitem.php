<?php

/**
 * This is the model class for table "propertyitem".
 *
 * The followings are the available columns in table 'propertyitem':
 * @property string $name
 * @property integer $propertyItemID
 * @property integer $propertyID
 *
 * The followings are the available model relations:
 * @property Existence[] $existences
 * @property Existence[] $existences1
 * @property Existence[] $existences2
 * @property Property $property
 */
class Propertyitem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Propertyitem the static model class
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
		return 'propertyitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, propertyID', 'required'),
			array('propertyID', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, propertyItemID, propertyID', 'safe', 'on'=>'search'),
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
			'existences' => array(self::HAS_MANY, 'Existence', 'propertyItemID1'),
			'existences1' => array(self::HAS_MANY, 'Existence', 'propertyItemID2'),
			'existences2' => array(self::HAS_MANY, 'Existence', 'propertyItemID3'),
			'property' => array(self::BELONGS_TO, 'Property', 'propertyID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'propertyItemID' => 'Property Item',
			'propertyID' => 'Property',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('propertyItemID',$this->propertyItemID);
		$criteria->compare('propertyID',$this->propertyID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}