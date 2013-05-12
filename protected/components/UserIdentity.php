<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $email = strtolower($this->username);
        $user = User::model()->find('LOWER(email)=?', array($email));

        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif (!$user->validatePassword($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID; else {
            $this->_id = $user->userID;
            $this->username = $user->email;
            $this->setState('login', $user->name.' '.$user->surname);

            $this->errorCode = self::ERROR_NONE;
        }

        return ($this->errorCode == self::ERROR_NONE) ? true : false;
    }

    public function getId()
    {
        return $this->_id;
    }
}