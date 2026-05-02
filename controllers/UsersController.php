<?php

require_once 'models/Users.php';
require_once 'helpers/Responser.php';
require_once 'helpers/Auther.php';
require_once 'models/Tokens.php';
require_once 'helpers/Inputter.php';

class UsersController
{
    public static function users()
    {
        $users = Users::all();
        Responser::ok($users);
    }

    public static function getUser()
    {
        $input = Inputter::getInput();
        $stmt = Users::getUser($input->id, null);
        if (empty($stmt)) {
            Responser::bad();
        }
        Responser::ok($stmt);
    }

    public static function create()
    {
        $role = AuthControllers::auth();
        $input = Inputter::getInput();
        $stmt = Users::create($input->name, password_hash($input->password, PASSWORD_DEFAULT), $input->role ?? 'staff');
        if ($stmt > 0) {
            Responser::ok(['message' => 'user successfully created', 'role' => $role]);
        }
        Responser::bad(['message' => 'cannot create user']);
    }

    public static function delete()
    {
        $input = Inputter::getInput();
        $stmt = Users::delete($input->id);
        if ($stmt > 0) {
            Responser::ok(['message' => 'user successfully deleted']);
        }
        Responser::bad(['message' => 'user not found']);
    }
}
