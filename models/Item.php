<?php

require_once 'helpers/Databaser.php';

class Item
{
    public static function create($sku, $name, $category_id, $description)
    {
        $stmt = Databaser::runQuery('INSERT INTO item(sku, name, category_id, description, quantity) VALUES(?, ?, ?, ?, 0)', [$sku, $name, $category_id, $description]);

        return $stmt->rowCount();
    }

    public static function getBySKU($sku)
    {
        $stmt = Databaser::runQuery('SELECT * FROM item WHERE sku = ?', [$sku]);

        return $stmt->fetch();
    }

    public static function getAll($limit, $offset)
    {
        $stmt = Databaser::runQuery('SELECT * FROM item LIMIT ? OFFSET ?', [$limit, $offset]);

        return $stmt->fetchAll();
    }

    public static function getById($id)
    {
        $stmt = Databaser::runQuery('SELECT * FROM item WHERE id = ?', [$id]);

        return $stmt->fetch();
    }

    public static function delete($id)
    {
        $stmt = Databaser::runQuery('DELETE FROM item WHERE id = ?', [$id]);

        return $stmt->rowCount();
    }

    public static function patch($id, $name, $value)
    {
        $stmt = Databaser::runQuery('UPDATE item SET '.$name.' = ? WHERE id = ?', [$value, $id]);

        return $stmt->rowCount();
    }

    public static function isColumnExist($col)
    {
        $stmt = Databaser::runQuery('SHOW COLUMNS FROM item WHERE Field = ?', [$col]);

        return ! empty($stmt->fetch());
    }

    public static function increase($id, $quantity)
    {
        $stmt = Databaser::runQuery('UPDATE item SET quantity = quantity + ? WHERE id = ?', [$quantity, $id]);
    }

    public static function decrease($id, $quantity)
    {
        $stmt = Databaser::runQuery('UPDATE item SET quantity = quantity - ? WHERE id = ?', [$quantity, $id]);
    }

    public static function adjust($id, $quantity)
    {
        $stmt = Databaser::runQuery('UPDATE item SET quantity = ? WHERE id = ?', [$quantity, $id]);
    }
}
