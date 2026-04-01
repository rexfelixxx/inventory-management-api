<?php

require_once 'models/Users.php';
require_once 'helpers/Responser.php';
require_once 'helpers/Auther.php';
require_once 'models/Tokens.php';

class UsersController
{
    public static function login()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $name = $input['name'] ?? null;
        $password = $input['password'] ?? null;
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
        $role = self::auth() ?? null;
        if (empty($role)) {
            Responser::bad();
        }
        $users = Users::getAll();
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
}
