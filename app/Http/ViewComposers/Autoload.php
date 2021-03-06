<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use App\logic\Web_cht;
use App\logic\Login;
use App\logic\Redis_tool;
use App\logic\Admin_user_logic;
use App\logic\Service_logic;
use App\logic\Role_logic;
use App\logic\Basetool;

class Autoload extends Basetool
{
    
    public function GetMenu(View $view)
    {

        $_this = new self();
	
        /* get user role as redis key */

        $Login_user = Session::get('Login_user');

        $Role_data = Admin_user_logic::get_user_role_by_id( $Login_user["user_id"] );

        $Role_array = !empty($Role_data) ? $_this->get_object_or_array_key($Role_data) : array();

        $Role_array = json_encode($Role_array);

        /* get user role as redis key */

        $data = Service_logic::menu_list($Role_array);

        $service_list = Service_logic::menu_format($data);

        $service_id = Session::get('service_id') ? intval(Session::get('service_id')) : 0 ;

        $service_id = isset($_GET["service_id"]) ? intval($_GET["service_id"]) : $service_id ;

        $auth_check = $service_id > 0 ? Service_logic::auth_check($service_id, $service_list) : true;

        !$auth_check ? header("Location: /index") : "" ;

        Session::put('service_id', $service_id);

        $data = compact('service_list', 'service_id');

    	$view->with($data);

    }

    public function GetTxt(View $view)
    {
	
        $txt = Web_cht::get_txt();

    	$active_to_text = array(1 => $txt["enable"], 2 => $txt["disable"]);

        $data = compact('txt', 'active_to_text');

    	$view->with($data);

    }

    public function CheckLogin(View $view)
    {
    
        $is_login = Login::is_user_login();

        if ($is_login) 
        {
            $user = Login::get_login_user_data();

            $data = compact('user');

            $view->with($data);
            
        }else
        {
            header("Location: /login");
            exit();
        }

    }

    public function SearchTool(View $view)
    {

        $search_tool = Redis_tool::get_search_tool();

        $active_role_list = Role_logic::get_active_role();

        $data = compact('search_tool', 'active_role_list');

        $view->with($data);

    }
}

?>