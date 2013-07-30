<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 05.07.13
 * Time: 6:26
 * To change this template use File | Settings | File Templates.
 */

class Mailer
{
    /**
     * @param $user
     * @param $subject
     * @param $msg
     * @param $order
     * @return bool
     */
    public function sendMailWithAttachment($user, $subject, $msg, $order)
    {
//----------------текст письма---------------
        $message = $user->name . ', здравствуйте!<br>';
        $message .= $msg . '<br><br>';

        $message .= '----------------------------------------<br>';
        $message .= 'С уважением, Ольга Махова .<br > ';
        $message .= 'Attribute.pro <br>';
        $message .= 'http://attribute.pro ';

        $bound = md5(time()); //разделитель

        //---------------создание письма--------------------
        $to = $user->email;
        $subject = '=?utf-8?b?' . base64_encode($subject) . '?=';

        $header = 'From: =?utf-8?b?' . base64_encode("Интернет-магазин модных аксессуаров Attribute.pro") . '?= <info@attribute.pro> \r\n';
        $header .= 'MIME-Version:1.0 \r\n';
        $header .= 'Content-type:multipart/mixed; boundary=' . $bound . ' \r\n';

        $body = '--' . $bound . ' \r\n';
        $body .= 'Content-type: text/html; charset=utf-8 \r\n';
        $body .= 'Content-Transfer-Encoding: quoted-printable \r\n\r\n';

        $body .= $message . ' \r\n\r\n';

        if ($order !== null) {
            $file_path = Yii::app()->basePath . '/backend/invoice/' . $order->orderID . '.pdf';
            $file = fopen($file_path, "rb");
            if ($file) {
                $data = fread($file, filesize($file_path));
                fclose($file);

                $body .= '--' . $bound . ' \r\n';

                $body .= 'Content-Type: application/octet-stream \r\n';
                $body .= 'Content-Transfer-Encoding: base64 \r\n';
                $body .= 'Content-Disposition: attachment; filename="invoice.pdf" \r\n\r\n';

                $body .= chunk_split(base64_encode($data)) . ' \r\n';
                $body .= '--' . $bound . '-- \r\n';
            }
        }
        return mail($to, $subject, $body, $header);
    }

    public function sendMailSimple($user, $subject, $msg)
    {
        $message = $user->name . ', здравствуйте!<br><br > ';
        $message .= $msg . '<br ><br > ';

        $message .= '----------------------------------------<br>';
        $message .= 'С уважением, Ольга Махова .<br > ';
        $message .= 'Attribute.pro<br>';
        $message .= 'http://attribute.pro ';

        $to = $user->email;
        $subject = "=?utf-8?b?" . base64_encode($subject) . "?=";

        $header = "From: =?utf-8?b?" . base64_encode("Интернет-магазин модных аксессуаров Attribute.pro") . "?= <info@attribute.pro> \r\n";
        $header .= 'Content-type: text/html; charset=utf-8\r\n';

        return mail($to, $subject, $message, $header);
    }
}