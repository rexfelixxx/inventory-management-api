<?php

require_once 'helpers/Inputter.php';
require_once 'models/Item.php';
require_once 'helpers/Responser.php';

class ItemController
{
    public static function create()
    {
        $sku = strtoupper(Inputter::requiredBodyData('sku'));
        $name = ucwords(strtolower(Inputter::requiredBodyData('name')));
        $category_id = Inputter::getBodyData('category_id') ?? null;
        $description = Inputter::getBodyData('description') ?? null;

        $result = Item::create($sku, $name, $category_id, $description);
        if ($result > 0) {
            Responser::ok('Successfully created new item');
        }
        Responser::bad('Failed to create new item');
    }

    public static function get($paths)
    {
        if (! empty($paths[1])) {
            $id = ctype_digit($paths[1]) ? $paths[1] : null;
            $sku = empty($id) ? $paths[1] : null;
            $result = empty($id) ? Item::getBySKU($sku) : Item::getById($id);

            if (empty($result)) {
                Responser::bad('Item not found');
            }
            Responser::ok('successfuly find item', $result);
        }

        $limit = $_GET['limit'] ?? 20;
        $offset = $_GET['offset'] ?? 0;
        $result = Item::getAll($limit, $offset);
        Responser::ok('successfully find all item', $result);
    }

    public static function delete($paths)
    {
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('Item id not specified!');
        }
        $result = Item::delete($id);

        if ($result > 0) {
            Responser::ok('Item successfully deleted');
        }

        Responser::bad('Cannot find item with that id, failed to delete user');
    }

    public static function patch($paths)
    {
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('Item id not specified!');
        }

        if (empty(Item::getById($id))) Responser::bad('Theres no item with that id');

        $data = Inputter::getAllBody();
        if(empty($data))Responser::bad('You wasting my time');
        $message = '';
        foreach($data as $key => $value){
            if(!is_string($key) && !is_string($value)){
                $message = $message.'Error: key and value must be the string type, ';
                continue;
            }
            if(!Item::isColumnExist($key)){
                $message = $message.'Error: Theres no column named '.$key.', ';
                continue;
            }
            $result = Item::patch($id, $key, $value);
            if($result > 0)
            {
                $message = $message.'Success: changed '.$key.' to '.$value.', ';
            }
        }
        $message = substr($message, 0, -2);
        Responser::ok($message);
    }
}
