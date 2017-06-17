<?php

namespace App\logistics;

class Web_cht
{
   
   protected $txt = array(
                  "account"               => "帳號",
   					"password"              => "密碼",
   					"real_name"             => "姓名",
   					"telephone"             => "電話",
   					"auth"                  => "權限",
   					"status" 			      => "狀態",
                  "edit"                  => "修改",
   					"send"                  => "送出",
                  "action"                => "動作",
                  "enable"                => "啟用",
   					"disable" 			      => "停用",
                  "admin_user_list"       => "管理員列表",
                  "admin_user_input"      => "管理員設定",
                  "account_input"         => "請輸入帳號",
                  "password_input"        => "請輸入密碼",
                  "verify_input"          => "驗證碼(四位數字)",
                  "Site"                  => "FileCloud",
                  "login"                 => "登入",
                  "logout"                => "登出",
                  "role_list"             => "角色列表",
                  "role_name"             => "角色",
                  "role_input"            => "角色設定",
                  "service_name"          => "服務名稱",
                  "link"                  => "連結",
                  "parents_service"       => "從屬服務",
                  "sort"                  => "排序",
                  "service_list"          => "服務列表",
                  "service_input"         => "服務設定",
                  "select_default"        => "請選擇",
                  "record_list"           => "記錄列表",
                  "filter"                => "篩選",
                  "search_tool"           => "搜尋工具",
                  "Show"                  => "顯示",
                  "Hide"                  => "隱藏",
                  "Date"                  => "日期",
                  "Range"                 => "區間",
                  "refresh_verify_code"   => "更換驗證碼",
   				);

   public static function get_txt()
   {
   		
   		$_this = new self;
   		
   		return $_this->txt;
   
   }

}