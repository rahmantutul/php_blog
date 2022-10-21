<?php 

class Session{

   public static function startSession(){
     session_start();
   }

   public static function setSession($key, $val){
       $_SESSION[$key]=$val;
   }

   public static function getSession($key){
      if(isset($_SESSION[$key])){
        return $_SESSION[$key];
      }else{
        return false;
      }
   }

   public static function checkSession(){
    self::startSession();
    if(self::getSession('login') ==false){
        self::destroySession();
        header("Location:login.php");
    }
   }

   public static function destroySession(){
     session_destroy();
     header("Location:login.php");
   }


}
?>