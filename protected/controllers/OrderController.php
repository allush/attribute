<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 02.06.13
 * Time: 21:05
 * To change this template use File | Settings | File Templates.
 */

class OrderController extends OrderControllerCommon
{
    public function actionCart()
    {
//        session_start();
        $sessid = session_id();

        $order = $this->loadOrderBySessid($sessid);
        $this->render('cart', array('order' => $order));
    }

    public function actionAddToCart($productID)
    {
//        session_start();
        $sessid = session_id();

        /** @var $product Product */
        $product = Product::model()->findByPk($productID);

        $order = $this->loadOrderBySessid($sessid);
        if ($order === null) {
            $order = new Order();
            $order->sessid = $sessid;
            $order->save();
        }

        $orderItem = OrderItem::model()->findByAttributes(array(
            'orderID' => $order->orderID,
            'productID' => $productID,
        ));

        if ($orderItem === null) {
            $orderItem = new OrderItem();
            $orderItem->orderID = $order->orderID;
            $orderItem->productID = $productID;
        }

        if (($orderItem->quantity + 1) > $product->existence) {
            echo 'Вы заказали все что есть в наличии!';
            Yii::app()->end();
        }

        $orderItem->quantity++;
        $orderItem->save();

        echo $order->sum() . ' p.';
    }

    public function actionOrderCompletion()
    {
//        session_start();
        $sessid = session_id();

        $order = $this->loadOrderBySessid($sessid);
        if ($order !== null) {
            $this->render('orderCompletion', array('order' => $order));
        }
    }


    public function actionUpdateOrderItemQuantity($id)
    {
        if (isset($_POST['OrderItem']['quantity'])) {
            /** @var $model OrderItem */
            $model = OrderItem::model()->findByPk($id);

            $needQuantity = abs($_POST['OrderItem']['quantity']);

            if ($needQuantity > $model->product->existence) {
                $needQuantity = $model->product->existence;
            }
            $model->quantity = $needQuantity;
            $model->save();
        }
    }

    public function actionDeleteOrderItem($id)
    {
        $model = OrderItem::model()->findByPk($id);
        if ($model !== null) {
            $model->delete();
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionClearOrder($orderID)
    {
        OrderItem::model()->deleteAllByAttributes(array(
            'orderID' => $orderID
        ));

        $this->redirect(Yii::app()->request->urlReferrer);
    }
}