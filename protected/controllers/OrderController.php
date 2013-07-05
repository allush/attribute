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

    public function actionFailURL()
    {
    }

    public function actionSuccessURL()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Неверное обращение к скрипту");
        }

        if (!isset($_POST['OutSum'])) {
            die("Не указана сумма платежа");
        }
        if (!isset($_POST['InvId'])) {
            die("Не указан номер счета");
        }
        if (!isset($_POST['SignatureValue'])) {
            die("Не указана контрольная сумма");
        }
        if (!isset($_POST['shp_id_order'])) {
            die("Не указан идектификатор заказа");
        }

        $mrh_pass1 = "re50_fdn";

        $shp_id_order = $_POST['shp_id_order'];
        $out_summ = $_POST['OutSum'];
        $inv_id = $_POST['InvId'];
        $crc = $_POST['SignatureValue'];

        $crc = strtoupper($crc); // force uppercase

// build own CRC
        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:shp_id_order=$shp_id_order"));

        if (strtoupper($my_crc) != strtoupper($crc)) {
            die("Контрольная сумма не совпадает");
        }

        /** @var $order Order */
        $order = Order::model()->findByPk($shp_id_order);

        if ($order->orderID != $inv_id) {
            die("Заказа с таким номером не существует в системе");
        }

        if ($order->sum() != $out_summ) {
            die("Сумма не совпадает");
        }

        $this->render('success');
    }

    public function actionResultURL()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Неверное обращение к скрипту");
        }

        if (!isset($_POST['OutSum'])) {
            die("Не указана сумма платежа");
        }
        if (!isset($_POST['InvId'])) {
            die("Не указан номер счета");
        }
        if (!isset($_POST['SignatureValue'])) {
            die("Не указана контрольная сумма");
        }
        if (!isset($_POST['shp_id_order'])) {
            die("Не указан идектификатор заказа");
        }

        $mrh_pass2 = "attribute2013_2h3";

        $shp_id_order = $_POST['shp_id_order'];
        $out_summ = $_POST['OutSum'];
        $inv_id = $_POST['InvId'];
        $crc = $_POST['SignatureValue'];

        $crc = strtoupper($crc);

        //build own CRC
        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:shp_id_order=$shp_id_order"));

        if (strtoupper($my_crc) != strtoupper($crc)) {
            die("Неверная контрольная сумма\n");
        }

        /** @var $order Order */
        $order = Order::model()->findByPk($shp_id_order);

        if ($order->orderID != $inv_id) {
            die("Заказа с таким номером не существует в системе");
        }

        if ($order->sum() != $out_summ) {
            die("Сумма не совпадает");
        }
        $order->orderStatusID = 2;
        $order->save();

        //print OK signature
        echo "OK$inv_id\n";
    }

    public function actionComplete()
    {
        if (isset($_POST['MrchLogin'])) {

            // curl запрос к робокассе
        } else {
            $order = $this->loadAuto();
            $invoice = new Invoice($order);
            $invoice->generate();
            $mailer = new Mailer();
            $mailer->sendMail($order->user, '', $order);
        }

        $a = 0;
    }

    public function actionCart()
    {
        $order = $this->loadAuto();
        $otherIncompleteOrders = array();
        if (!Yii::app()->user->isGuest && is_object($order)) {
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
            echo 'null';
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

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];
            $model->save();
        }
    }

    public function actionUnion($orderID1, $orderID2)
    {
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