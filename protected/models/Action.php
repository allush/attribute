<?php

/**
 * This is the model class for table "action".
 *
 * The followings are the available columns in table 'action':
 * @property integer $actionID
 * @property string $picture
 * @property string $title
 * @property string $description
 * @property integer $expires
 */
class Action extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Action the static model class
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
        return 'action';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('picture, title', 'required'),
            array('expires', 'numerical', 'integerOnly' => true),
            array('picture, title, description', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('actionID, picture, title, description, expires', 'safe', 'on' => 'search'),
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
            'actionID' => 'ID',
            'picture' => 'Картинка (810*300 пикселей)',
            'title' => 'Название',
            'description' => 'Описание',
            'expires' => 'Истекает',
        );
    }

    public function picture()
    {
        return Yii::app()->baseUrl . '/img/actions/' . $this->picture;
    }

    protected function beforeValidate()
    {
        if (strlen($this->expires) == 0) {
            $this->expires = null;
        } else {
            $this->expires = $this->expiresToInt();
        }

        return parent::beforeValidate();
    }

    public function expiresToStr()
    {
        if (is_numeric($this->expires)) {
            return date('Y-m-d', $this->expires);
        }elseif(is_null($this->expires)){
            return 'Постоянная акция';
        }

        return $this->expires;
    }

    public function expiresToInt()
    {
        if (is_numeric($this->expires)) {
            return $this->expires;
        }

        return strtotime($this->expires);
    }
}