<?php

namespace App\Http\Controllers;

use App\logic\Option_logic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OptionController extends Controller
{

	/*  
		array(
				"data" 		=> array(
									array(
										"key" 	=> '',
										"value" => ''
									)
								),
				"redirect" 	=> ""
			)
	*/

    public function set_option(Request $request)
    {

        if ($request->hasFile('logo_upload')) 
        {

            // getimagesize($_FILES["logo_upload"]["tmp_name"])

            // logo block logistic call here...

            $request->file('logo_upload');
            $_POST["logo_upload_path"] = $request->logo_upload->store('logo');
        }

    	// filter

        $data = Option_logic::set_option_format( $_POST );

        $redirect = $data["redirect"];

        unset($data["redirect"]);

        // save

        Option_logic::set_option( $data );
        
        Option_logic::save_config();

        return redirect($redirect);

    }	

    public function web_setting()
    {

        $option_array = array();
 
        $assign_page = "option/web_setting";

        $key = "/admin/web_setting";

        $option_key = Option_logic::get_option_key( $key );

        $option_data = Option_logic::get_option_format( array($option_key) );

        $option_data = Option_logic::get_option( $option_data );

        if (!empty($option_data->count())) 
        {
            foreach ($option_data as $row) 
            {
                $option_array = json_decode($row->value);
            }
        }

        $data = compact('assign_page', 'option_array', 'key');

        return view('webbase/content', $data);

    }

    public function proxy_setting()
    {

        $option_array = array(
                            "Proxy_IP"  => "",
                            "account"   => "",
                            "password"  => ""
                        );
 
        $assign_page = "option/proxy_setting";

        $key = "/admin/proxy_setting";

        $option_key = Option_logic::get_option_key( $key );

        $option_data = Option_logic::get_option_format( array($option_key) );

        $option_data = Option_logic::get_option( $option_data );

        if (!empty($option_data->count())) 
        {
            foreach ($option_data as $row) 
            {
                $option_array = json_decode($row->value, true);
            }
        }

        $data = compact('assign_page', 'option_array', 'key');

        return view('webbase/content', $data);

    }

    public function time_setting()
    {

        $option_array = array(
                            "time_format"   => "",
                            "NTP_server"    => "",
                            "timezone"      => ""
                        );

        $time_format = array(
                            "yyyy-mm-dd",
                            "yyyy/mm/dd",
                            "mm/dd/yy",
                            "dd/mm/yy"
                        );

        $timezone = array();

        foreach (timezone_abbreviations_list() as $key1 => $row) 
        {
            foreach ($row as $key2 => $value) 
            {
                if (isset($value["timezone_id"])) 
                {
                    $timezone[$value["timezone_id"]] = $value["timezone_id"];
                }
            }
        }

        asort($timezone);
 
        $assign_page = "option/time_setting";

        $key = "/admin/time_setting";

        $option_key = Option_logic::get_option_key( $key );

        $option_data = Option_logic::get_option_format( array($option_key) );

        $option_data = Option_logic::get_option( $option_data );

        if (!empty($option_data->count())) 
        {
            foreach ($option_data as $row) 
            {
                $option_array = json_decode($row->value, true);
            }
        }

        $data = compact('assign_page', 'option_array', 'key', 'time_format', 'timezone');

        return view('webbase/content', $data);

    }

    public function logo_setting()
    {

        Storage::makeDirectory("logo");

        $assign_page = "option/logo_setting";

        $key = "/admin/logo_setting";

        $option_key = Option_logic::get_option_key( $key );

        $option_data = Option_logic::get_option_format( array($option_key) );

        $option_data = Option_logic::get_option( $option_data );

        if (!empty($option_data->count())) 
        {
            foreach ($option_data as $row) 
            {
                $option_array = json_decode($row->value, true);
            }
        }

        $data = compact('assign_page', 'option_array', 'key');

        return view('webbase/content', $data);

    }

    public function path_setting()
    {

        $option_array = array(
                            "path_name"         => "",
                            "ip"                => "",
                            "hostname"          => "",
                            "domain"            => "",
                            "verify_account"    => "",
                            "password"          => "",
                            "path_of_folder"    => array("")
                        );

        $assign_page = "option/path_setting";

        $key = "/admin/path_setting";

        $option_key = Option_logic::get_option_key( $key );

        $option_data = Option_logic::get_option_format( array($option_key) );

        $option_data = Option_logic::get_option( $option_data );

        if (!empty($option_data->count())) 
        {
            foreach ($option_data as $row) 
            {
                $option_array = json_decode($row->value, true);
            }
        }

        $data = compact('assign_page', 'option_array', 'key');

        return view('webbase/content', $data);

    }

    public function mail_setting()
    {

        $option_array = array(
                            "mail_server"            => "",
                            "mail_account"           => "",
                            "mail_password"          => ""
                        );

        $assign_page = "option/mail_setting";

        $key = "/admin/mail_setting";

        $option_key = Option_logic::get_option_key( $key );

        $option_data = Option_logic::get_option_format( array($option_key) );

        $option_data = Option_logic::get_option( $option_data );

        if (!empty($option_data->count())) 
        {
            foreach ($option_data as $row) 
            {
                $option_array = json_decode($row->value, true);
            }
        }

        $data = compact('assign_page', 'option_array', 'key');

        return view('webbase/content', $data);

    }

    public function restriction_setting()
    {

        $option_array = array(
                            "restriction_type"            => array(),
                            "restriction_upload_size"     => ""
                        );

        $assign_page = "option/restriction_setting";

        $restriction_type_array = array(
                                        1   =>  "圖片",
                                        2   =>  "文件",
                                        3   =>  "影音",
                                        4   =>  "壓縮檔"
                                    );

        $key = "/admin/restriction_setting";

        $option_key = Option_logic::get_option_key( $key );

        $option_data = Option_logic::get_option_format( array($option_key) );

        $option_data = Option_logic::get_option( $option_data );

        if (!empty($option_data->count())) 
        {
            foreach ($option_data as $row) 
            {
                $option_array = json_decode($row->value, true);
            }
        }

        $data = compact('assign_page', 'option_array', 'key', 'restriction_type_array');

        return view('webbase/content', $data);

    }

    public function protect_setting()
    {

        $option_array = array(
                            "protect_save_pwd"          => false,
                            "protect_reverify"          => 5,
                            "protect_auto_logout"       => false
                        );

        $assign_page = "option/protect_setting";


        $key = "/admin/protect_setting";

        $option_key = Option_logic::get_option_key( $key );

        $option_data = Option_logic::get_option_format( array($option_key) );

        $option_data = Option_logic::get_option( $option_data );

        if (!empty($option_data->count())) 
        {
            foreach ($option_data as $row) 
            {
                $option_array = json_decode($row->value, true);
            }
        }

        $data = compact('assign_page', 'option_array', 'key');

        return view('webbase/content', $data);

    }

}