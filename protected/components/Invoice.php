<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 05.07.13
 * Time: 6:27
 * To change this template use File | Settings | File Templates.
 */

class Invoice
{
    /** @var $_order Order */
    private $_order;
    /** @var $_user User */
    private $_user;

    public function __construct($order)
    {
        $this->_order = $order;
        $this->_user = $this->_order->user;
    }

    public function generate()
    {
        $mPDF = Yii::app()->basePath.'/components/mpdf/mpdf.php';
        include_once($mPDF);

        $pdf = new mPDF();
        $pdf->SetProtection(array('print'));

        //------указывем стиль для содержимого PDF документа------
        $style = file_get_contents(Yii::app()->basePath . "/../css/invoice.css");
        $pdf->WriteHTML($style, 1);

        //------Записываем шапку PDF документа------
        $head = "<table id='head'>";
        $head .= "<tr><td>Продавец:       </td><td>Махова О.</td></tr>";

        $head .= '<tr id="buyer"><td>Покупатель:</td><td>' . $this->_user->surname . ' ' . $this->_user->name . ' ' . $this->_user->patronymic . '</td></tr>';
        $head .= '<tr><td>Адрес:      </td><td>' . $this->_user->index . ', ' . $this->_user->country . ', ' . $this->_user->sity . ', ' . $this->_user->address . ',  тел. ' . $this->_user->phone . '</td></tr>';
        $head .= '</table>';

        $pdf->WriteHTML($head, 2);
        $pdf->WriteHTML("<div id='invoice'>Счет №" . $this->_order->orderID . ' от ' . date("d-m-Y", $this->_order->modifiedOn) . "</div>");

        //------Список позиций заказа
        $body = "<table id='order_items'><tr>";
        $body .= "<td>№</td>";
        $body .= "<td>Наименование</td>";
        $body .= "<td class='center'>Ед. изм.</td>";
        $body .= "<td class='center'>Кол-во</td>";
        $body .= "<td class='center'>Цена</td>";
        $body .= "<td class='center'>Сумма</td></tr>";

        $total = 0;
        $i = 0;
        foreach ($this->_order->orderItems as $item) {
            $sum = $item->product->price() * $item->quantity;
            $total += $sum;

            $body .= "<tr>";
            $body .= '<td>' . (++$i) . '</td>';
            $body .= '<td>' . $item->product->name . '</td>';
            $body .= '<td class="center">' . $item->product->unit . '</td>';
            $body .= '<td class="center">' . $item->quantity . '</td>';
            $body .= '<td class="center">' . $item->product->priceCurrency() . '</td>';
            $body .= '<td class="center" >' . $sum . ' руб</td>';
            $body .= '</tr>';
            $sum = 0;
        }

        $body .= '<tr>';
        $body .= '<td></td>';
        $body .= '<td></td>';
        $body .= '<td></td>';
        $body .= '<td></td>';
        $body .= '<td class="center" id="itogo"> Итого:</td>';
        $body .= '<td class="center" id="itogo">' . $total . ' руб</td>';
        $body .= '</tr>';
        $body .= '</table>';

        $body .= "<div id='value_spell'>Сумма прописью: " . $this->num2char($total) . " 00 коп . Без НДС .</div>";
        $body .= "<div id='director'> Руководитель предприятия ____________________ </div> ";
        $body .= "<div id='accountant'> Бухгалтер __________________ </div> ";

        $pdf->WriteHTML($body, 2);

        $name = Yii::app()->basePath . '/backend/invoice/' . $this->_order->orderID . '.pdf';
        $pdf->Output($name, 'F');

        return $name;
    }


    private function num2char($number)
    {
        $rubs = array(0 => "рублей", 1 => "рубль", 2 => "рубля", 3 => "рубля", 4 => "рубля", 5 => "рублей", 6 => "рублей", 7 => "рублей", 8 => "рублей", 9 => "рублей");

        $names = array(
            // 0..999
            1 => array(
                // ..x
                1 => array(
                    0 => 'ноль',
                    1 => 'один',
                    2 => 'два',
                    3 => 'три',
                    4 => 'четыре',
                    5 => 'пять',
                    6 => 'шесть',
                    7 => 'семь',
                    8 => 'восемь',
                    9 => 'девять',
                    12 => 'одна', // одна тысяча (12 - число, триада)
                    22 => 'две', // две тысячи  (22 - число, триада)
                ),
                // .x.
                2 => array(
                    // .xx
                    1 => array(
                        0 => 'десять',
                        1 => 'одиннадцать',
                        2 => 'двенадцать',
                        3 => 'тринадцать',
                        4 => 'четырнадцать',
                        5 => 'пятнадцать',
                        6 => 'шестнадцать',
                        7 => 'семнадцать',
                        8 => 'восемнадцать',
                        9 => 'девятнадцать',
                    ),
                    2 => 'двадцать',
                    3 => 'тридцать',
                    4 => 'сорок',
                    5 => 'пятьдесят',
                    6 => 'шестьдесят',
                    7 => 'семьдесят',
                    8 => 'восемьдесят',
                    9 => 'девяносто',
                ),
                // x..
                3 => array(
                    1 => 'сто',
                    2 => 'двести',
                    3 => 'триста',
                    4 => 'четыреста',
                    5 => 'пятьсот',
                    6 => 'шестьсот',
                    7 => 'семьсот',
                    8 => 'восемьсот',
                    9 => 'девятьсот',
                ),
            ),
            // 0..999`000
            2 => array(
                // .x. x..
                0 => 'тысяч',
                // ..x
                1 => 'тысяча',
                2 => 'тысячи',
                3 => 'тысячи',
                4 => 'тысячи',
                5 => 'тысяч',
                6 => 'тысяч',
                7 => 'тысяч',
                8 => 'тысяч',
                9 => 'тысяч',
            ),
            3 => array(
                // .x. x..
                0 => 'миллионов',
                // ..x
                1 => 'миллион',
                2 => 'миллиона',
                3 => 'миллиона',
                4 => 'миллиона',
                5 => 'миллионов',
                6 => 'миллионов',
                7 => 'миллионов',
                8 => 'миллионов',
                9 => 'миллионов',
            ),
            4 => array(
                // .x. x..
                0 => 'миллиардов',
                // ..x
                1 => 'миллиард',
                2 => 'миллиарда',
                3 => 'миллиарда',
                4 => 'миллиарда',
                5 => 'миллиардов',
                6 => 'миллиардов',
                7 => 'миллиардов',
                8 => 'миллиардов',
                9 => 'миллиардов',
            ),
            5 => array(
                // .x. x..
                0 => 'триллионов',
                // ..x
                1 => 'триллион',
                2 => 'триллиона',
                3 => 'триллиона',
                4 => 'триллиона',
                5 => 'триллионов',
                6 => 'триллионов',
                7 => 'триллионов',
                8 => 'триллионов',
                9 => 'триллионов',
            ),
            6 => array(
                // .x. x..
                0 => 'триллиардов',
                // ..x
                1 => 'триллиард',
                2 => 'триллиарда',
                3 => 'триллиарда',
                4 => 'триллиарда',
                5 => 'триллиардов',
                6 => 'триллиардов',
                7 => 'триллиардов',
                8 => 'триллиардов',
                9 => 'триллиардов',
            ),
        );

        $strRet = '';

        if ($number == 0) {
            $strRet = $names[1][1][0] . ' ' . $rubs[6];
        }
        // наращиваем ведущие нули, чтобы длина числа была кратна трём
        if (strlen($number) % 3 != 0) {
            $number = str_repeat('0', 3 - strlen($number) % 3) . $number;
        }

        $triad_count = strlen($number) / 3;
        $triad_array = array();

        // рубим число на триады (начиная с правого края)
        for ($i = 1; $i <= $triad_count; $i++) {
            $triad_array[$i] = substr($number, -($i * 3), 3);
        }

        // наращиваем результирующую строку
        $i = 0;
        foreach ($triad_array as $triada => $number) {
            $str = '';

            // цифры триады - 321
            $n1 = intval(substr($number, 2, 1));
            $n2 = intval(substr($number, 1, 1));
            $n3 = intval(substr($number, 0, 1));

            // ..надцать
            if ($n2 == 1) {
                // числительное
                $str = $names[1][2][1][$n1]; // 10..19
                $str = ' ' . $str;
            } else {
                if ($n1) {
                    // исключение - тысяча женского рода (один -> одна, два -> две)
                    if ($triada == 2 && ($n1 == 1 || $n1 == 2)) {
                        $str = $names[1][1][$n1 . '2'];
                    } else {
                        $str = $names[1][1][$n1];
                    }
                    $str = ' ' . $str;
                }

                if ($n2) {
                    $str = $names[1][2][$n2] . $str;
                    $str = ' ' . $str;
                }

            }

            if ($n3) {
                $str = $names[1][3][$n3] . $str;
            }

            // для чисел больше 999 дописываем название триады, но только если в триада не равна 000
            if ($triada > 1 && ($n1 || $n2 || $n3)) {
                // ..надцать
                if ($n2 == 1) {
                    $str = $str . ' ' . $names[$triada][0];
                } else {
                    $str = $str . ' ' . $names[$triada][$n1];
                }
            }

            $strRet = $str . ' ' . $strRet;

            if (!$i)
                $temp = $n1;
            if ($i + 1 >= $triad_count)
                $strRet .= ' ' . $rubs[$temp];
            $i++;
        }

        return $strRet;
    }
}