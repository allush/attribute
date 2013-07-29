<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 03.07.13
 * Time: 8:51
 * To change this template use File | Settings | File Templates.
 */

class WebUser extends CWebUser
{
    public function changeIdentity($id, $name, $states)
    {
        $this->setId($id);
        $this->setName($name);
        $this->loadIdentityStates($states);
    }
}