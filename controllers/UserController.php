<?php

require_once 'helpers/Responser.php';
require_once 'models/User.php';
require_once 'helpers/Inputter.php';
require_once 'controllers/AuthController.php';

class UserController
{
    public static function get($paths)
    {
        Auth::requiredPrivilegeLevel(1);
        $id = $paths[1] ?? null;
        if (! empty($id)) {
            $result = User::getById($id);
            if (empty($result)) {
                Responser::bad('User not found');
            }
            Responser::ok('successfuly find user', $result);
        }
        $limit = $_GET['limit'] ?? 20;
        $offset = $_GET['offset'] ?? 0;
        $result = User::getAll($limit, $offset);
        Responser::ok('successfully find all users', $result);
    }

    public static function create()
    {
        Auth::requiredPrivilegeLevel(2);
        $name = Inputter::requiredBodyData('name');
        $password = password_hash(Inputter::requiredBodyData('password'), PASSWORD_DEFAULT);
        $role = Inputter::getBodyData('role') ?? 'staff';

        $result = User::create($name, $password, $role);

        if ($result > 0) {
            Responser::ok('User successfully created');
        }

        Responser::bad('Failed to create new user');
    }

    public static function delete($paths)
    {

        Auth::requiredPrivilegeLevel(2);
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('User id not specified!');
        }
        $result = User::delete($id);

        if ($result > 0) {
            Responser::ok('User successfully deleted');
        }

        Responser::bad('Cannot find user with that id, failed to delete user');
    }

    public static function update($paths)
    {
        Auth::requiredPrivilegeLevel(2);
        $id = $paths[1] ?? null;
        if (empty($id)) {
            Responser::bad('User id not specified!');
        }
        $name = Inputter::requiredBodyData('name');
        $password = password_hash(Inputter::requiredBodyData('password'), PASSWORD_DEFAULT);

        $result = User::update($id, $name, $password);
        if ($result > 0) {
            Responser::ok('User successfully updated');
        }

        Responser::bad('Failed to update new user');

    }
}
