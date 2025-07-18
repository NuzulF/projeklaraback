<?php
// app/Helpers/OrderId.php

namespace App\Helpers;

class OrderId
{
    public static function generate()
    {
        return strtoupper(substr(md5(strtotime("now")), 0, 10));
    }

    public static function tiket($order_id)
    {
        return $order_id.strtotime("now");
    }
}