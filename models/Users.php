<?php

require_once 'helpers/Databaser.php';

class Users
{
    public static function getUser($name)
    {
        $account = Databaser::runQuery('SELECT * FROM users WHERE BINARY name = ?', [$name]);

        return $account;
    }

    public static function getAll()
    {
        $data = Databaser::runQuery('SELECT * FROM users');

        return $data;
    }
}
