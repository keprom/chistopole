<?php
function datetostring($date)
{
    $d = explode("-", $date);
    return $d['2'] . '.' . $d['1'] . '.' . $d['0'];
}

function f_d($var)
{
    if ($var == 0) return "&nbsp;"; else
        return sprintf("%22.2f", round($var * 100) / 100);
}

function f_d2($var)
{
    if ($var == 0) return "&nbsp;"; else
        return sprintf("%22.2f", round($var * 100) / 100);
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Счет на оплату</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="/css/fullpage.css">
</head>
<body class="portrait">
<?php $data_schet = strlen($data_schet) == 0 ? datetostring($schetfactura_date->date) : $data_schet; ?>
<table class="block">
    <tr>
        <td align="center"><b>СЧЕТ<?php echo $schet; ?></b> №<?php echo $number . ' от ' . $data_schet; ?></td>
        <td> (1)</td>
    </tr>
    <tr>
        <td><b>Поставщик</b> <u><?php echo $org->org_name; ?></u></td>
        <td> (2)</td>
    </tr>
    <tr>
        <td> БИН и адрес местнахождения поставщика <u><?php echo $org->bin . " " . $org->address; ?></u>
        </td>
        <td> (2а)</td>
    </tr>
    <tr>
        <td> Расчетный счет поставщика <u><?php echo $org->IIK; ?> КБЕ-<?php echo $org->Bank_kbe; ?>
                КНП-<?php echo $org->bank_knp; ?> <?php echo $org->bank_name; ?>
                БИК <?php echo $org->bank_bik; ?></u></td>
        <td> (2б)</td>
    </tr>
    <tr>
        <td> Свидетельство о постановке на регистрационный учет по
            НДС <?php echo $org->svidetelstvo_nds; ?> </td>
        <td></td>
    </tr>
    <tr>
        <td> Договор(контракт) на поставку товаров (работ, услуг)
            №<u><?php echo $firm->dogovor . " </u> от <u> " . datetostring($firm->dogovor_date); ?></u>
        </td>
        <td> (3)</td>
    </tr>
    <tr>
        <td> Условия оплаты по договору (контракту) <u><?php echo $firm->edit1; ?></u></td>
        <td> (3а)</td>
    </tr>
    <tr>
        <td> Пункт назначения поставляемых товаров (работ,
            услуг)<u><?php echo $firm->edit2; ?>                                                                                                                                           </u>
        </td>
        <td> (4)</td>
    </tr>
    <tr align="right">
        <td><i>(государство, регион, область, город, район)</i></td>
        <td></td>
    </tr>
    <tr>
        <td> Поставка товаров осуществлена по доверенности №<u><?php echo $firm->edit3; ?></u></td>
        <td> (5)</td>
    </tr>
    <tr>
        <td> Способ отправления <u><?php echo $firm->edit4; ?></u></td>
        <td> (6)</td>
    </tr>
    <tr>
        <td> Товарно-транспортная накладная №_________________ от _____________________________________</td>
        <td> (7)</td>
    </tr>
    <tr>
        <td> Грузоотправитель <u><?php echo "БИН " . $org->bin . ", " . $org->org_name . ", " . $org->address; ?></u></td>
        <td> (8)</td>
    </tr>
    <tr align="right">
        <td align="center"><i>(РНН, наименование и адрес места нахождения)</i></td>
        <td></td>
    </tr>
    <tr>
        <td> Грузополучатель <u><?php echo $firm->edit6; ?></u></td>
        <td> (9)</td>
    </tr>
    <tr align="right">
        <td align="center"><i>(РНН, наименование и адрес места нахождения)</i></td>
        <td></td>
    </tr>
    <tr>
        <td><b>Получатель</b><u><?php echo "{$firm->name}"; ?></u></td>
        <td>(10)</td>
    </tr>
    <tr>
        <td> РНН, БИН и адрес местонахождения получателя
            <u><?php echo $firm->rnn . ", " . $firm->bin . " " . $firm->address; ?></u></td>
        <td>(10а)</td>
    </tr>
    <tr>
        <td> Расчетный счет получателя <u><?php echo $firm->raschetnyy_schet; ?></u> в банке
            <u><?php echo $bank->name; ?></u></td>
        <td>(10б)</td>
    </tr>
</table>
<br>
<table class="border-table block">
    <tr>
        <td align="center" rowspan="2">№ п/п</td>
        <td align="center" rowspan="2">Наименование товаров(работ, услуг)</td>
        <td align="center" rowspan="2">Ед. изм.</td>
        <td align="center" rowspan="2">Кол-во(объем)</td>
        <td align="center" rowspan="2">Цена тенге</td>
        <td align="center" rowspan="2">Стоимость товаров(работ, услуг) без НДС</td>
        <td align="center" colspan="2">НДС</td>
        <td align="center" rowspan="2">Всего стоимость реализации</td>
        <td align="center" colspan="2">Акциз</td>
    </tr>
    <tr>
        <td align="center">Ставка</td>
        <td align="center">Сумма</td>
        <td align="center">Ставка</td>
        <td align="center">Сумма</td>
    </tr>
    <tr>
        <td align="center"><i>1</i></td>
        <td align="center"><i>2</i></td>
        <td align="center"><i>3</i></td>
        <td align="center"><i>4</i></td>
        <td align="center"><i>5</i></td>
        <td align="center"><i>6</i></td>
        <td align="center"><i>7</i></td>
        <td align="center"><i>8</i></td>
        <td align="center"><i>9</i></td>
        <td align="center"><i>10</i></td>
        <td align="center"><i>11</i></td>
        <?php $sum_bez_nds = 0;
        $sum_nds = 0;
        $sum = 0;
        $i = 1;
        for ($j = 0;
        $j < $tariff_count;
        $j++):
        if ($tariff_kvt[$j] == 0) continue;
        ?>
    </tr>
    <tr>
        <td align="center"><?php echo $i++; ?></td>
        <td align="center">Электроэнергия</td>
        <td align="center">кВт</td>
        <td align="center"><?php echo f_d($tariff_kvt[$j]); ?></td>
        <td align="center"><?php echo f_d($tariff_value[$j]); ?></td>
        <td align="center">
            <?php
            echo f_d($tariff_kvt[$j] * $tariff_value[$j]);
            $sum_bez_nds += f_d2($tariff_kvt[$j] * $tariff_value[$j]);
            ?>
        </td>
        <td align="center"> <?php echo f_d($period->nds); ?></td>
        <td align="center">
            <?php echo f_d($period->nds * $tariff_kvt[$j] * $tariff_value[$j] / 100);
            $sum_nds += $period->nds * $tariff_kvt[$j] * $tariff_value[$j] / 100; ?>
        </td>
        <td align="center">
            <?php echo
            f_d(($period->nds + 100) * $tariff_kvt[$j] * $tariff_value[$j] / 100);
            $sum += ($period->nds + 100) * $tariff_kvt[$j] * $tariff_value[$j] / 100; ?>
        </td>
        <td align="center">0</td>
        <td align="center">0</td>
        <?php endfor; ?>
    </tr>
    <tr>
        <td align="left" colspan="5"><b>Всего по счету:</b></td>
        <td align="right"><b><?php echo f_d2($sum_bez_nds); ?></b></td>
        <td align="right" class="gray-cube">&nbsp;</td>
        <td align="right"><b><?php echo f_d2($sum_nds); ?></b></td>
        <td align="right"><b><?php echo f_d2($sum_bez_nds + $sum_nds); ?></b></td>
        <td align="right" class="gray-cube">&nbsp;</td>
        <td align="right"><b></b></td>
    </tr>
</table>
<p><?php echo num2str(f_d2($sum_bez_nds + $sum_nds)); ?></p>
<br>
<table class="block">
    <tr>
        <td align="left">Руководитель организации</td>
        <td align="right">ВЫДАЛ (Ответственное лицо поставщика)</td>
    </tr>
    <tr>
        <td align="left"><?php echo $org->director; ?>____________</td>
        <td align="right">Техник ____________________________</td>
    </tr>
    <tr>
        <td align="left">(Ф.И.О., подпись)</td>
        <td align="right">(Ф.И.О., подпись)</td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
        <td align="right">&nbsp;</td>
    </tr>

    <tr>
        <td align="left">Главный бухгалтер организации</td>
        <td align="right">Бухгалтер потребителя</td>
    </tr>
    <tr>
        <td align="left"><?php echo $org->glav_buh; ?>_______________</td>
        <td align="right">___________________</td>
    </tr>
    <tr>
        <td align="left">(Ф.И.О., подпись)</td>
        <td align="right">(Ф.И.О., подпись)</td>
    </tr>
    <tr>
        <td align="left"><br/>Примечание. Без печати недействительно.<br/>
            Оригинал (первый экземпляр)-покупателю.<br/>
            Копия (второй экземпляр)-поставщику.
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>