<?php

require_once 'helpers/Databaser.php';

class Stock
{
    public static function create($item_id, $action, $quantity, $description, $user_id, $move_at)
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

    public static function delete($id)
    {
        $stmt = Databaser::runQuery('DELETE FROM stock_movement WHERE id = ?', [$id]);

        return $stmt->rowCount();
    }

    public static function put($id, $item_id, $description, $user_id, $move_at)
    {
        $stmt = Databaser::runQuery('UPDATE stock_movement SET item_id = ?, description = ?, user_id = ?, move_at = ? WHERE id = ?', [$item_id, $description, $user_id, $move_at, $id]);

        return $stmt->rowCount();
    }

    public static function patch($id, $action, $quantity)
    {
        Databaser::startTransaction();
        try {
            $current_log = Databaser::runQuery('SELECT quantity, item_id FROM stock_movement WHERE id = ?', [$id])->fetch();
            $last_quantity = $current_log['quantity'];
            $item_id = $current_log['item_id'];
            Databaser::runQuery('UPDATE stock_movement SET action = ?, quantity = ? WHERE id = ?', [$action, $quantity, $id]);
            if ($action == 'in') {
                Databaser::runQuery('UPDATE item SET quantity = quantity - ? + ? WHERE id = ?', [$last_quantity, $quantity, $item_id]);
            }
            if ($action == 'out') {
                Databaser::runQuery('UPDATE item SET quantity = quantity + ? - ? WHERE id = ?', [$last_quantity, $quantity, $item_id]);
            }
            if ($action == 'adjustment') {
                Databaser::runQuery('UPDATE item SET quantity = ? WHERE id = ?', [$quantity, $item_id]);
            }

            Databaser::commit();

            return true;
        } catch (PDOException $e) {
            Databaser::rollback();
            Responser::bad('Error'.$e->getMessage());

            return false;
        }
    }
}
