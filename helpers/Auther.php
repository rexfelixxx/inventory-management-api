<?php

class Auther
{
    public static function generateToken()
    {
        $bytes = random_bytes(16);

        return bin2hex($bytes);
    }

    private static function getAuthHeader()
    {
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['HTTP_AUTHORIZATION']);
        }
        if (isset($_SERVER['Authorization'])) {
            return trim($_SERVER['Authorization']);
        }
    }

    public static function getBearerToken()
    {
        $auth = self::getAuthHeader();
        if ($auth && preg_match('/Bearer\s(\S+)/', $auth, $matches)) {
            return $matches[1];
        }
    }
}
