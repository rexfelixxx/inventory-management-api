<?php

require_once 'models/Users.php';
require_once 'helpers/Responser.php';
require_once 'helpers/Auther.php';
require_once 'models/Tokens.php';
require_once 'helpers/Inputter.php';

class UsersController
{
    public static function login()
    {
        $input = Inputter::getInput();
        $name = $input->name ?? null;
        $password = $input->password ?? null;
        if ((empty($name) or empty($password))) {
            Responser::bad();
        }

        $user = Users::getUser($name, $password);

        if (! $user) {
            Responser::bad();
        }

        if (password_verify($password, $user['password'])) {
            $existingToken = Tokens::get($user['id']);
            $token = Auther::generateToken();
            if (empty($existingToken)) {
                Tokens::create($token, $user['id']);
            } else {
                Tokens::update($existingToken['id'], $token);
            }
            Responser::ok(['token' => $token]);
        } else {
            Responser::bad();
        }
    }

    public static function users()
    {
        $users = Users::all();
        Responser::ok($users);
    }

    public static function auth()
    {
        $token = Auther::getBearerToken();
        if (empty($token)) {
            Responser::bad();
        }
        $existingToken = Tokens::getUser($token);
        if ($existingToken) {
            Responser::ok($existingToken);
        }
        Responser::bad();
    }

    public static function create()
    {
        $input = Inputter::getInput();
        $stmt = Users::create($input->name, password_hash($input->password, PASSWORD_DEFAULT), $input->role ?? 'staff');
        if ($stmt > 0) {
            Responser::ok(['message' => 'user successfully created']);
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
