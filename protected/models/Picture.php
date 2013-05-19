<?php

/**
 * This is the model class for table "picture".
 *
 * The followings are the available columns in table 'picture':
 * @property integer $productPictureID
 * @property string $filename
 * @property integer $productID
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class Picture extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Picture the static model class
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
        return 'picture';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('filename, productID', 'required'),
            array('productID', 'numerical', 'integerOnly' => true),
            array('filename', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('productPictureID, filename, productID', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'productPictureID' => 'Product Picture',
            'filename' => 'Filename',
            'productID' => 'Product',
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

        $criteria->compare('productPictureID', $this->productPictureID);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('productID', $this->productID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function thumbnail()
    {
        return Yii::app()->baseUrl . '/images/product/thumbnail/' . $this->filename;
    }

    public function large()
    {
        return Yii::app()->baseUrl . '/images/product/large/' . $this->filename;
    }
}