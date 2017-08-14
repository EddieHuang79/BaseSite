<?php

namespace App\logic;

use App\logic\Admin_user_logic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\logic\Verifycode;

class Login extends Basetool
{

   public static function login_format( $data )
   {
         
         $_this = new self();

         $result = array(
                        "account"       => isset($data["email"]) && !empty($data["email"]) ? trim($data["email"]) : "",
                        "password"      => isset($data["pwd"]) && !empty($data["pwd"]) ? $_this->strFilter($data["pwd"]) : "",
                        "verify_code"   => isset($data["verify"]) && !empty($data["verify"]) ? intval($data["verify"]) : 0,
                        "token"         => isset($data["_token"]) && !empty($data["_token"]) ? $_this->strFilter($data["_token"]) : "",
                        "created_at"    => date("Y-m-d H:i:s")
                     );

         return $result;

   }

   public static function login_verify( $data )
   {

         $result = "";
         
         try{

            $user_id = Admin_user_logic::get_user_id( $data );

            if (empty($user_id))
            {

               $msg = "帳號輸入錯誤！";

               throw new \Exception($msg);
            
            }

            $user_data = Admin_user_logic::get_user( $user_id );

            $compare = Hash::check( $data["password"], $user_data->password );

            if (!$compare) 
            {
               $msg = "密碼輸入錯誤！";

               throw new \Exception($msg);
            }

            $compare = Verifycode::auth_verify_code( $data["verify_code"] );
   
            if (!$compare) 
            {
               $msg = "驗證碼輸入錯誤！";

               throw new \Exception($msg);
            } 

            $data["real_name"] = $user_data->real_name;

            Session::forget('ErrorMsg');

            $Session_data = Login::login_session_format( $user_id, $data );

            Session::put( 'Login_user', $Session_data );

         }catch(\Exception $e){

            $result = $e->getMessage();

         }

         return $result;

   }


   public static function login_session_format( $user_id, $user_data )
   {
         
         $_this = new self();

         $result = array(
                        "user_id"       => isset($user_id) ? $user_id : 0,
                        "account"       => isset($user_data["account"]) ? $user_data["account"] : "",
                        "real_name"     => isset($user_data["real_name"]) ? $user_data["real_name"] : "",
                        "token"         => isset($user_data["token"]) ? $user_data["token"] : "",
                        "time"          => isset($user_data["created_at"]) ? strtotime($user_data["created_at"]) : time()
                     );

         return $result;

   }

   public static function is_user_login()
   {
         
         $Login_user = Session::get('Login_user');

         $result = empty($Login_user["user_id"]) ? false : true ;
         $result = empty($Login_user["account"]) ? false : $result ;
         $result = empty($Login_user["real_name"]) ? false : $result ;
         $result = empty($Login_user["token"]) ? false : $result ;
         $result = empty($Login_user["time"]) ? false : $result ;

         return $result;

   }

   public static function get_login_user_data()
   {
         
         $Login_user = Session::get('Login_user');

         return $Login_user;

   }

   public static function logout()
   {
         
         Session::forget('Login_user');

   }

}