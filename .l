<?php

require_once 'models/Stock.php';
require_once 'models/Item.php';

require_once 'helpers/Inputter.php';
require_once 'helpers/Responser.php';

class StockController
{
    public static function create()
    {
        $item_id = Inputter::requiredBodyData('item_id');
        $action = Inputter::requiredBodyData('action');
        $quantity = Inputter::requiredBodyData('quantity');
        $description = Inputter::getBodyData('description');
        $user_id = Inputter::requiredBodyData('user_id');
        $move_at = Inputter::requiredBodyData('move_at');
        Databaser::transaction(
            function () {
                global $item_id, $action, $quantity, $description, $user_id, $move_at;
                $log_stock = Stock::post($item_id, $action, $quantity, $description, $user_id, $move_at); 
            });
    }
}
