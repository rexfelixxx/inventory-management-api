<?php

require_once 'helpers/Responser.php';
class DefaultController
{
    public static function notFound()
    {
        Responser::custom(404, 'Not found', null);
    }
}
