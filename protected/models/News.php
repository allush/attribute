<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $newsID
 * @property string $header
 * @property string $content
 */
class News extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return News the static model class
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
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('header', 'required'),
            array('header', 'length', 'max' => 255),
            array('content', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'newsID' => 'News',
            'header' => 'Заголовок',
            'content' => 'Содержание',
        );
    }
}