<?php

require_once 'helpers/Databaser.php';

class Stock
{
    public static function post($item_id, $action, $quantity, $description, $user_id, $move_at)
    {
        $stmt = Databaser::runQuery('INSERT INTO stock_movement(item_id, action, quantity, description, user_id, move_at) VALUES(?, ?, ?, ?, ?, ?)', [$item_id, $action, $quantity, $description, $user_id, $move_at]);

        return $stmt->rowCount();
    }

    public static function get($id, $limit, $offset, $userid, $itemid)
    {
        $query = 'SELECT * FROM stock_movement ';
        $filters = [];
        if (! empty($id)) {
            $stmt = Databaser::runQuery($query.'WHERE id = '.$id, []);

            return $stmt->fetch();
        }

        if (! empty($userid)) {
            array_push($filters, 'user_id = '.$userid);
        }
        if (! empty($itemid)) {
            array_push($filters, 'item_id = '.$itemid);
        }

        if (! empty($filters)) {
            $query = $query.'WHERE '.implode(' AND ', $filters);
        }

        if (! empty($limit)) {
            $query = $query.' LIMIT '.$limit;
        }
        if (! empty($offset)) {
            $query = $query.' OFFSET '.$offset;
        }

        $stmt = Databaser::runQuery($query, []);

        return $stmt->fetchAll();
    }
}
