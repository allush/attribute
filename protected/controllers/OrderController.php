<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 02.06.13
 * Time: 21:05
 * To change this template use File | Settings | File Templates.
 */

class OrderController extends FrontController
{
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'postOnly + deleteOrderItem, clearOrder', // we only allow deletion via POST request
        );
    }

    public function actionCart()
    {
        $order = $this->loadAuto();
        $otherIncompleteOrders = array();
        if (!Yii::app()->user->isGuest) {
            $userID = Yii::app()->user->getState('userID');
            $otherIncompleteOrders = Order::model()->findAll(array(
                'condition' => 'userID=:userID AND orderID<>:orderID AND orderStatusID IS NULL',
                'params' => array(
                    ':userID' => $userID,
                    ':orderID' => $order->orderID,
                )
            ));
        }

        $this->render('cart', array(
            'order' => $order,
            'otherIncompleteOrders' => $otherIncompleteOrders
        ));
    }

    public function actionAddToCart($productID)
    {
        $order = $this->loadAuto(true);

        $orderItem = OrderItem::model()->findByAttributes(array(
            'orderID' => $order->orderID,
            'productID' => $productID,
        ));

        if ($orderItem === null) {
            $orderItem = new OrderItem();
            $orderItem->orderID = $order->orderID;
            $orderItem->productID = $productID;
        }

        /** @var $product Product */
        $product = Product::model()->findByPk($productID);
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
        $order = $this->loadAuto();
        if ($order !== null) {
            $this->render('orderCompletion', array('order' => $order));
        }
    }

    /**
     * Изменение кол-ва заказываемого товара из корзины
     * @param $id OrderItemID
     * @throws CHttpException
     */
    public function actionUpdateOrderItemQuantity($id)
    {
        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(403, 'Неверное использование');
        }

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

    public function actionUnion($orderID1,$orderID2){
        /** @var $order1 Order */
        /** @var $order2 Order */

        $order1 = Order::model()->findByPk($orderID1);
        $order2 = Order::model()->findByPk($orderID2);

        $order1->union($order2);
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * Удалить пункт заказа из корзины
     * @param $id
     */
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

    /**
     * @param $id
     * @return Order
     * @throws CHttpException
     */
    protected static function loadModel($id)
    {
        /** @var $model Order */
        $model = Order::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

}