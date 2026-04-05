<?php

class Inputter{
  public static function getInput(){
    $input = json_decode(file_get_contents('php://input'));
    return $input;
}
}
