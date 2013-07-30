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
     * @param null $order
     * @return bool
     */
    public function sendMailWithAttachment($user, $subject, $msg, $order = null)
    {
//----------------текст письма---------------
        $message = $user->name . ', здравствуйте!<br>';
        $message .= $msg . '<br><br>';

        $message .= '----------------------------------------<br>';
        $message .= 'С уважением, Ольга Махова .<br > ';
        $message .= 'Attribute.pro <br>';
        $message .= 'http://attribute.pro ';

        $bound = session_id(); //разделитель

        //---------------создание письма--------------------
        $to = $user->email;
        $subject = "=?utf-8?b?" . base64_encode($subject) . "?=";

        $header = "from: =?utf-8?b?" . base64_encode("Интернет-магазин модных аксессуаров Attribute.pro") . "?= <info@attribute.pro> \n";
        $header .= 'mime-version: 1.0 \n';
        $header .= 'content-type: multipart/mixed; boundary=' . $bound . '\n';

        $body = "--$bound\n";
        $body .= "content-type: text/html; charset=utf-8 \n";
        $body .= "content-transfer-encoding: quoted-printable \n\n";

        $body .= "$message\n\n";

        if ($order !== null) {
            $file_path = Yii::app()->basePath . '/backend/invoice/' . $order->orderID . '.pdf';
            $file = fopen($file_path, "rb");
            if ($file) {
                $data = fread($file, filesize($file_path));
                fclose($file);

                $body = "--$bound\n";

                $body .= "content-type: application/pdf ; name = \"" . '=?utf-8?b?' . base64_encode("Счет_" . $user->surname) . '?=.pdf' . "\"\n";
                $body .= "content-transfer-encoding: base64\n";
                $body .= "content-disposition: attachment; filename = \"" . '=?utf-8?b?' . base64_encode("Счет_" . $user->surname) . '?=.pdf' . "\"\n\n";

                $body .= chunk_split(base64_encode($data)) . "\n";
                $body .= "--" . $bound . "--\n";
            }
        }

        return mail($to, $subject, $body, $header);
    }

    public function sendMailSimple($user, $subject, $msg)
    {
        $message = $user->name . ', здравствуйте!<br><br>';
        $message .= $msg . '<br><br>';

        $message .= '----------------------------------------<br>';
        $message .= 'С уважением, Ольга Махова .<br > ';
        $message .= 'Attribute.pro <br>';
        $message .= 'http://attribute.pro ';

        $to = $user->email;
        $subject = "=?utf-8?b?" . base64_encode($subject) . "?=";

        $header = "From: =?utf-8?b?" . base64_encode("Интернет-магазин модных аксессуаров Attribute.pro") . "?= <info@attribute.pro> \r\n";
        $header .= 'Content-type: text/html; charset=utf-8\r\n';

        return mail($to, $subject, $message, $header);
    }
}