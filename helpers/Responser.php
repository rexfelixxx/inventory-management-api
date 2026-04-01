<?php

class Responser
{
    private static function return_response($code = 200, $status = 'ok', $data = 'no data returned')
    {
        http_response_code($code);
        echo json_encode([
            'status' => $status,
            'data' => $data,
        ]);
        exit;
    }

    public static function ok($data = null)
    {
        self::return_response(200, 'ok', $data);
    }

    public static function bad($data = null)
    {
        self::return_response(400, 'bad request', $data);
    }

    public static function custom($code, $status, $data)
    {
        self::return_response($code, $status, $data);
    }
}
