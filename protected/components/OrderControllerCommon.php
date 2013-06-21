<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 21.06.13
 * Time: 10:37
 * To change this template use File | Settings | File Templates.
 */
class OrderControllerCommon extends Controller
{
    /**
     * @param $id
     * @return Order
     * @throws CHttpException
     */
    protected function loadOrder($id)
    {
        /** @var $model Order */
        $model = Order::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * @param $sessid
     * @return Order
     * @throws CHttpException
     */
    protected function loadOrderBySessid($sessid)
    {
        /** @var $model Order */
        $model = Order::model()->findByAttributes(array('sessid' => $sessid));
        return $model;
    }
}
