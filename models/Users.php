<?php

require_once 'helpers/Databaser.php';

class Users
{
    public static function getUser($name)
    {
        $account = Databaser::runQuery('SELECT * FROM users WHERE BINARY name = ?', [$name]);

        return $account;
    }

    public static function all()
    {
        $stmt = Databaser::runQuery('SELECT * FROM users');
        

        return $stmt->fetchAll();
    }

    public static function create($name, $password, $role = 'staff'){
      $stmt = Databaser::runQuery('INSERT INTO users(name, password, role) VALUES(?, ?, ?)',[$name, $password, $role]);
      return $stmt->rowCount();
    }

    public static function delete($id){
      $stmt = Databaser::runQuery('DELETE FROM users WHERE id = ?', [$id]);
      return $stmt->rowCount();
    }
}
