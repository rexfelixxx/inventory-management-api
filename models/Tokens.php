<?php
require_once 'helpers/Databaser.php';

class Tokens{
  public static function new($token, $user_id){
    Databaser::runQuery("INSERT INTO tokens(token, user_id) VALUES(?, ?)", [$token, $user_id]);
  }
  public static function get($user_id, $token = null){
    if(isset($user_id)){
      return (Databaser::runQuery("SELECT * FROM tokens WHERE user_id = ?", [$user_id]));
    }
if(isset($token)){
      return (Databaser::runQuery("SELECT * FROM tokens WHERE token = ?", [$token]));
    }
  }
  public static function update($id, $token){
    Databaser::runQuery("UPDATE tokens SET token = ? WHERE id = ?", [$token, $id]); 
  }
}
