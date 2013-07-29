<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class BackendLoginForm extends CFormModel
{
    public $email;
    public $password;
    public $rememberMe = false;

    private $_identity = null;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('email, password', 'required'),
            // электронная почта должна быть корректной
            array('email', 'email'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe' => 'Запомнить меня',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new BackendUserIdentity($this->email, $this->password);

            $authCode = $this->_identity->authenticate();
            if ($authCode === BackendUserIdentity::ERROR_NOT_ACTIVATED) {
                $this->addError('password', 'Учетная запись не активирована');
            } elseif ($authCode !== true) {
                $this->addError('password', 'Неверный адрес электронной почты или пароль');
            }
        }
        // если ошибок нет
        if ($this->_identity->errorCode === BackendUserIdentity::ERROR_NONE) {
            // если установлена галочка "Запомнить меня", устаналиваем время жизни в куки
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else {
            return false;
        }
    }
}
