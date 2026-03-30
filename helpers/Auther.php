<?php

class Auther
{
    public static function generateToken()
    {
        $bytes = random_bytes(16);

        return bin2hex($bytes);
    }
}
