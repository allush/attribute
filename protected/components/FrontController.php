<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 25.06.13
 * Time: 18:56
 * To change this template use File | Settings | File Templates.
 */
class FrontController extends CController
{
    public $order = null;

    public function __construct($id, CWebModule $module = null)
    {
        $this->order = self::loadAuto();
        parent::__construct($id, $module);
    }

    /**
     * @param bool $create
     * @return Order
     */
    public static function loadAuto($create = false)
    {
        $sessid = session_id();
        $order = null;
        if (Yii::app()->user->isGuest) {
            /** @var $model Order */
            $order = Order::model()->findByAttributes(array('sessid' => $sessid));
            if ($order === null && $create) {
                $order = new Order();
                $order->sessid = $sessid;
                $order->save();
            }
        } else {
            $userID = Yii::app()->user->getState('userID');
            $order = Order::model()->findByAttributes(array(
                'userID' => $userID,
                'orderStatusID' => null,
            ));
            if ($order === null && $create) {
                /** @var $order Order */
                $order = new Order();
                $order->userID = $userID;
                $order->sessid = $sessid;
                $order->save();
            }
        }
        return $order;
    }

    public function orderSum()
    {
        $order = self::loadAuto();
        if ($order === null) {
            return 0;
        }
        return $order->sum();
    }

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/default';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
}
