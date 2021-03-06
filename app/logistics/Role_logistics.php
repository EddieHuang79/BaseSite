<?php

namespace App\logistics;

use Illuminate\Database\Eloquent\Model;
use App\model\Role;
use App\logistics\Redis_tool;

class Role_logistics extends Basetool
{

   public static function insert_format( $data )
   {
         
         $_this = new self();

         $result = array(
                        "name"          => isset($data["name"]) ? $_this->strFilter($data["name"]) : "",
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
                        "name"          => isset($data["name"]) ? $_this->strFilter($data["name"]) : "",
                        "status"        => isset($data["active"]) ? intval($data["active"]) : 0,
                        "updated_at"    => date("Y-m-d H:i:s")
                     );

         return $result;

   }

   public static function add_role_service_format( $role_id, $service_id, $data )
   {
      
         $result = array();

         if ( $role_id > 0 ) 
         {
            foreach ($data as $key => $value)
            {
               $result[] = array(
                                 "role_id"      => intval($role_id),
                                 "service_id"   => intval($value)
                           );
            }
         }

         if ( $service_id > 0 ) 
         {
            foreach ($data as $key => $value)
            {
               $result[] = array(
                                 "role_id"      => intval($value),
                                 "service_id"   => intval($service_id)
                           );
            }
         }

         return $result;

   }

   public static function get_role_list( $param = array() )
   {

         $_this = new self();

         $option = array(
                     "role_name" => !empty($param["role_name"]) ? $_this->strFilter($param["role_name"]) : "",
                     "status"    => !empty($param["status"]) ? intval($param["status"]) : ""
                  );


         return Role::get_role_list( $option );

   }

   public static function get_role( $id )
   {

         return Role::get_role( $id );

   }

   public static function get_role_service( $role_id = 0, $service_id = 0 )
   {

         $result = $service_id > 0 ? Role::get_role_service($role_id, $service_id)->mapWithKeys(function ($item) {
                                  return [$item->role_id => $item->service_id];
                              }) : Role::get_role_service($role_id, $service_id) ;

         return $result;

   }

   public static function get_active_role()
   {

         $result = Redis_tool::get_active_role();

         if (empty($result))
         {
            
            $result = Role::get_active_role();
            
            Redis_tool::set_active_role( $result );
         
         }

         return $result;

   }

   public static function add_role( $data )
   {

         return Role::add_role( $data );

   }

   public static function edit_role( $data, $role_id )
   {

         Role::edit_role( $data, $role_id );

   }

   public static function add_role_service( $data )
   {

         Role::add_role_service( $data );

   }

   public static function delete_role_service( $role_id = 0, $service_id = 0 )
   {

         Role::delete_role_service( $role_id, $service_id );

   }

}