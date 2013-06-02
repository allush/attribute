<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 02.06.13
 * Time: 21:05
 * To change this template use File | Settings | File Templates.
 */

class OrderController extends Controller
{
    public function actionCart()
    {
        $this->render('cart');
    }
}