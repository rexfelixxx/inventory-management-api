<?php

require_once 'models/Category.php';
require_once 'helpers/Responser.php';
require_once 'helpers/Inputter.php';
require_once 'helpers/Responser.php';
require_once 'controllers/AuthController.php';

class CategoryController
{
    public static function create()
    {
        Auth::requiredPrivilegeLevel(2);
        $name = Inputter::requiredBodyData('name');
        $result = Category::create($name);
        if ($result > 0) {
            Responser::ok('Category successfully created!');
        }
        Responser::bad('Failed to create new category');
    }

    public static function get($paths)
    {
        Auth::requiredPrivilegeLevel(1);
        $id = $paths[1] ?? null;
        if (! empty($id)) {
            $result = Category::getById($id);
            if (empty($result)) {
                Responser::bad('Category not found');
            }
            Responser::ok('Successfuly find category', $result);
        }
        $limit = $_GET['limit'] ?? 20;
        $offset = $_GET['offset'] ?? 0;
        $result = Category::getAll($limit, $offset);
        Responser::ok('Successfully find all categories', $result);
    }

    public static function delete($paths)
    {
        Auth::requiredPrivilegeLevel(1);
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('Category id not specified');
        }

        $result = Category::delete($id);
        if ($result > 0) {
            Responser::ok('Category with id '.$id.' is succesfully deleted');
        }

        Responser::bad('Failed to delete category with id: '.$id.', its not exist');
    }

    public static function update($paths)
    {
        Auth::requiredPrivilegeLevel(1);
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('Category id not specified');
        }
        $name = Inputter::requiredBodyData('name');

        $result = Category::update($id, $name);

        if ($result > 0) {
            Responser::ok('A category name successfulky updated');
        }

        Responser::bad('Failed to update a category name');
    }
}
