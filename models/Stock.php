<?php

require_once 'helpers/Databaser.php';

class Stock
{
    public static function post($item_id, $action, $quantity, $description, $user_id, $move_at)
    {
        $stmt = Databaser::runQuery('INSERT INTO stock_movement(item_id, action, quantity, description, user_id, move_at) VALUES(?, ?, ?, ?, ?, ?)', [$item_id, $action, $quantity, $description, $user_id, $move_at]);

        return $stmt->rowCount();
    }
}
