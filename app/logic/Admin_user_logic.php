<?php

namespace App\logic;

use App\model\Admin_user;

class Admin_user_logic extends Basetool
{

   public static function insert_format( $data )
   {
         
         $_this = new self();

         $result = array(
                        "account"       => isset($data["account"]) ? $_this->strFilter($data["account"]) : "",
                        "password"      => isset($data["password"]) ? $_this->strFilter($data["password"]) : "",
                        "real_name"     => isset($data["real_name"]) ? $_this->strFilter($data["real_name"]) : "",
                        "mobile"        => isset($data["mobile"]) ? $_this->strFilter($data["mobile"]) : "",
                        "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                        "created_at"    => date("Y-m-d H:i:s"),
                        "updated_at"    => date("Y-m-d H:i:s")
                     );

         return $result;

   }

   public static function update_format( $data )
   {

         $_this = new self();

         $result = array(
                        "real_name"     => isset($data["real_name"]) ? $_this->strFilter($data["real_name"]) : "",
                        "mobile"        => isset($data["mobile"]) ? $_this->strFilter($data["mobile"]) : "",
                        "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                        "updated_at"    => date("Y-m-d H:i:s")
                     );

         if (!empty($data["password"])) 
         {
            $result["password"] = bcrypt($_this->strFilter($data["password"]));
         }


         return $result;

   }

   public static function get_user_role_auth( $data, $rel_data )
   {

         $auth = array();

         foreach ($rel_data as $row)
         {
            $auth[$row->user_id][] = $row->name;
         }

         foreach ($data as &$row) 
         {
            $row->auth = isset($auth[$row->id]) ? $auth[$row->id] : array() ;
         }

         return $data;

   }  

   public static function add_user_role_format( $user_id, $data )
   {

         $result = array();

         foreach ($data as $key => $value)
         {
            $result[] = array(
                              "user_id"   => intval($user_id),
                              "role_id"   => intval($value)
                        );
         }

         return $result;

   }

   public static function get_user( $id = 0 )
   {

         return Admin_user::get_user( $id );

   }

   public static function get_user_list( $param = array() )
   {

         $_this = new self();

         $option = array(
                     "account"   => !empty($param["account"]) ? $_this->strFilter($param["account"]) : "",
                     "real_name" => !empty($param["real_name"]) ? $_this->strFilter($param["real_name"]) : "",
                     "user_id"   => !empty($param["role_id"]) ?  $_this->get_user_id_by_role(intval($param["role_id"])) : "",
                     "status"    => !empty($param["status"]) ? intval($param["status"]) : ""
                  );

         return Admin_user::get_user_list( $option );

   }

   public static function get_user_role()
   {

         return Admin_user::get_user_role();
         
   }

   public static function get_user_role_by_id( $id )
   {

         return Admin_user::get_user_role_by_id( $id );
         
   }

   public static function add_user( $data )
   {

         return Admin_user::add_user( $data );
         
   }

   public static function edit_user( $data, $user_id )
   {

         Admin_user::edit_user( $data, $user_id );
         
   }

   public static function add_user_role( $data )
   {

         Admin_user::add_user_role( $data );
         
   }

   public static function delete_user_role( $user_id )
   {

         Admin_user::delete_user_role( $user_id );
         
   }

   public static function get_user_id( $data )
   {

         return Admin_user::get_user_id( $data );
         
   }

   public static function get_user_id_by_role( $role_id )
   {

         $result = array();

         $data = Admin_user::get_user_id_by_role( $role_id );

         foreach ($data as $row) 
         {
            $result[] = $row->user_id;
         }

         return $result;
         
   }

}