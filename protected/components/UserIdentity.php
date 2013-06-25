<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_NOT_ACTIVATED = -1;
    const ERROR_EMAIL_NOT_EXISTS = -2;
    const ERROR_PASSWORD_NOT_VALID = -3;

    private $_id;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $email = strtolower($this->username);
        /** @var $user User */
        $user = User::model()->find('LOWER(email)=?', array($email));

        if ($user === null) {
            $this->errorCode = self::ERROR_EMAIL_NOT_EXISTS;
        } elseif (!$user->validatePassword($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_NOT_VALID;
        } elseif($user->activated != 1){
            $this->errorCode = self::ERROR_NOT_ACTIVATED;
        }
        else {
            $this->_id = $user->userID;
            $this->username = $user->email;

            $this->setState('login', $user->name . ' ' . $user->surname);
            $this->setState('userID', $user->userID);

            $this->errorCode = self::ERROR_NONE;
        }

        return ($this->errorCode == self::ERROR_NONE) ? true : $this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}