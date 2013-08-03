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

    /**
     * На исходном изображении поставить водяной знак, сохранив новое изображение как копию
     */
    public function setWatermark()
    {
        $logo = Yii::app()->basePath . '/../img/watermark.png';

        $largePath = Yii::app()->basePath . '/..' . $this->large();
        $watermarkPath = Yii::app()->basePath . '/..' .$this->watermark();

        $ih = new CImageHandler();
        $ih->load($largePath)
            ->watermark($logo, 15, 20, CImageHandler::CORNER_RIGHT_BOTTOM)
            ->save($watermarkPath);
    }

    /**
     * Из большого изображения с водяным знаком создать миниатюру
     */
    public function createThumbnail()
    {
        $watermarkPath = Yii::app()->basePath . '/..' . $this->watermark();
        $thumbnailPath = Yii::app()->basePath . '/..' . $this->thumbnail();

        // создать и сохранить миниатюру
        $ih = new CImageHandler();
        $ih->load($watermarkPath)
            ->thumb(400, 300)
            ->save($thumbnailPath);
    }

    public function watermark()
    {
        return Yii::app()->baseUrl . '/img/product/watermark/' . $this->filename;
    }

    public function thumbnail()
    {
        return Yii::app()->baseUrl . '/img/product/thumbnail/' . $this->filename;
    }

    public function large()
    {
        return Yii::app()->baseUrl . '/img/product/large/' . $this->filename;
    }

    protected function beforeDelete()
    {
        $largePath = Yii::app()->basePath . '/../img/product/large/' . $this->filename;
        $thumbnailPath = Yii::app()->basePath . '/../img/product/thumbnail/' . $this->filename;
        $watermarkPath = Yii::app()->basePath . '/../img/product/watermark/' . $this->filename;

        if (file_exists($largePath)) {
            unlink($largePath);
        }

        if (file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }

        if (file_exists($watermarkPath)) {
            unlink($watermarkPath);
        }

        return parent::beforeDelete();
    }
}