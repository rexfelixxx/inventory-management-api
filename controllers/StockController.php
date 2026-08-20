<?php

require_once 'models/Stock.php';
require_once 'models/Item.php';

require_once 'helpers/Inputter.php';
require_once 'helpers/Responser.php';
require_once 'controllers/AuthController.php';

class StockController
{
    public static function create()
    {
        Auth::requiredPrivilegeLevel(1);
        $item_id = Inputter::requiredBodyData('item_id');
        $action = Inputter::requiredBodyData('action');
        $quantity = Inputter::requiredBodyData('quantity');
        $description = Inputter::requiredBodyData('description');
        $user_id = Inputter::requiredBodyData('user_id');
        $move_at = Inputter::requiredBodyData('move_at');
        Databaser::startTransaction();
        try {
            Stock::create($item_id, $action, $quantity, $description, $user_id, $move_at);

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
        Auth::requiredPrivilegeLevel(1);
        $id = $paths[1] ?? null;
        $limit = $_GET['limit'] ?? null;
        $offset = $_GET['offset'] ?? null;
        $userid = $_GET['userid'] ?? null;
        $itemid = $_GET['itemid'] ?? null;

        $result = Stock::get($id, $limit, $offset, $userid, $itemid);
        Responser::ok('Success', $result);
    }

    public static function delete($paths)
    {
        Auth::requiredPrivilegeLevel(1);
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('Id not specified');
        }

        $result = Stock::delete($id);
        if ($result > 0) {
            Responser::ok('Stock Log Successfully Deleted');
        }

        Responser::bad('Failed to delete a stock log, theres no log with that id');
    }

    public static function put($paths)
    {
        Auth::requiredPrivilegeLevel(1);
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('Id not specified');
        }

        $item_id = Inputter::requiredBodyData('item_id');
        $description = Inputter::requiredBodyData('description');
        $user_id = Inputter::requiredBodyData('user_id');
        $move_at = Inputter::requiredBodyData('move_at');

        $result = Stock::put($id, $item_id, $description, $user_id, $move_at);
        if ($result > 0) {
            Responser::ok('A stock log successfully updated');
        }
        Responser::bad('Faled to update a stock log, theres no stock log with that id');
    }

    public static function patch($paths)
    {
        Auth::requiredPrivilegeLevel(1);
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('Id not specified');
        }

        $action = Inputter::requiredBodyData('action');
        $quantity = Inputter::requiredBodyData('quantity');

        if (Stock::patch($id, $action, $quantity)) {
            Responser::ok('Updated successfully');
        }

        Responser::bad('Update failed');
    }
}
