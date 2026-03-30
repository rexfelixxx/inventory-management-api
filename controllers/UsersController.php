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
          if(empty($existingToken)){
            Tokens::new($token, $user['id']);
          }else{
            Tokens::update($existingToken['id'], $token);
          }
          Responser::ok(['token' => $token]);
        } else {
          Responser::bad();
        }
    }

    public static function users()
    {
        $users = Users::getAll();
        Responser::ok($users);
    }

    public static function auth(){
        $input = json_decode(file_get_contents('php://input'), true);
        $token = $input['token'] ?? null;
        if(empty($token))Responser::bad();
        $existingToken = Tokens::get(null, $token);
        if($existingToken)Responser::ok();
        Responser::bad();
    }
}
