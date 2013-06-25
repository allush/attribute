<?php

/**
 * This is the model class for table "action".
 *
 * The followings are the available columns in table 'action':
 * @property integer $actionID
 * @property string $picture
 * @property string $beginOn
 * @property string $endOn
 * @property string $header
 * @property string $slogan
 * @property string $content
 */
class Action extends CActiveRecord
{
    public $picturePath;

    public function __construct($scenario = 'insert')
    {
        $this->picturePath = Yii::app()->basePath . '/../img/action/';

        parent::__construct($scenario);
    }

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
            array('beginOn, endOn, header', 'required'),
            array('picture, header, slogan', 'length', 'max' => 255),
            array('beginOn, endOn', 'date', 'format' => 'yyyy-MM-dd'),
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
            'actionID' => 'Action',
            'picture' => 'Картинка',
            'beginOn' => 'Начало',
            'endOn' => 'Окончение',
            'header' => 'Заголовок',
            'slogan' => 'Слоган',
            'content' => 'Содержание',
        );
    }

    protected function beforeDelete()
    {
        $this->deletePicture();
        return parent::beforeDelete();
    }

    public function picture()
    {
        $picture = '';
        if (strlen($this->picture) > 0 && $this->picture != null) {
            $picture = Yii::app()->baseUrl . '/img/action/' . $this->picture;
        }
        return $picture;
    }

    public function deletePicture()
    {
        // удалить картинку акции
        $pictureFile = $this->picturePath . $this->picture;
        if (file_exists($pictureFile) && is_file($pictureFile)) {
            unlink($pictureFile);
        }
    }
}