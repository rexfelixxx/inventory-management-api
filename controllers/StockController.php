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
        $description = Inputter::requiredBodyData('description');
        $user_id = Inputter::requiredBodyData('user_id');
        $move_at = Inputter::requiredBodyData('move_at');
        Databaser::startTransaction();
        try {
            Stock::post($item_id, $action, $quantity, $description, $user_id, $move_at);

            if ($action == 'in') {
                Item::increase($item_id, $quantity);
            }
            if ($action == 'out') {
                Item::decrease($item_id, $quantity);
            }
            Databaser::commit();
            Responser::ok('Succesfully created new stock log');
        } catch (PDOException $e) {
            Databaser::rollback();
            Responser::bad('Database error: '.$e->getMessage());
        }
    }

public static function get($paths)
    {
        $id = $paths[1] ?? null;
        $limit = $_GET['limit'] ?? null;
        $offset = $_GET['offset'] ?? null;
        $userid = $_GET['userid'] ?? null;
        $itemid = $_GET['itemid'] ?? null;

        $result = Stock::get($id, $limit, $offset, $userid, $itemid);
        Responser::ok("Success", $result);
    }
}
