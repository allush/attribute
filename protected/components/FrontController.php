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

    public $pageTitleBase = 'Attribute.pro';

    public $pageTitle = 'Интернет магазин модных аксессуаров, интересных подарков, полезных и красивых вещиц';
    public $description = 'Интернет магазин модных аксессуаров, интересных подарков, полезных и красивых вещиц';

    public function pageTitle()
    {
        return $this->pageTitleBase . ' - ' . $this->pageTitle;
    }

    /**
     * @param bool $create
     * @return Order
     */
    public static function loadAuto($create = false)
    {
        /** @var $session CHttpSession */
        /** @var $order Order */

        $session = Yii::app()->getSession();

        // найти анонимный заказ
        $order = Order::model()->findByAttributes(
            array(
                'sessid' => $session->sessionID,
                'userID' => null,
                'orderStatusID' => null,
            )
        );

        // если гость и нужно создать заказ(в случае добавления нового товара), то создать пустой заказ.
        if (Yii::app()->user->isGuest) {
            if ($order === null && $create) {
                $order = new Order();
                $order->sessid = $session->sessionID;
                $order->save();
            }
        } else {
            $userID = Yii::app()->user->getState('userID');

            // если есть анонимный заказ - привязываем его к пользователю, который осуществляет вход с той же сессией
            if ($order !== null) {
                $order->userID = $userID;
                $order->save();
            } else {
                // найти незавершенный заказ пользователя
                $order = Order::model()->findByAttributes(array(
                    'userID' => $userID,
                    'orderStatusID' => null,
                ));
                if ($order === null && $create) {
                    $order = new Order();
                    $order->userID = $userID;
                    $order->sessid = $session->sessionID;
                    $order->save();
                }
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
