<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\logic\Admin_user_logic;
use App\logic\Role_logic;
use App\logic\Service_logic;
use App\logic\Basetool;
use App\logic\Redis_tool;

class UserController extends Basetool
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // get now page

        Service_logic::get_service_id_by_url_and_save( $request->path() );

        // search bar setting

        $search_tool = array(2,3,4,5);

        Redis_tool::set_search_tool( $search_tool );

        $user = Admin_user_logic::get_user_list( $_GET );

        $user_role = Admin_user_logic::get_user_role();

        $user = Admin_user_logic::get_user_role_auth( $user, $user_role );
 
        $assign_page = "admin_user/admin_list";

        $data = compact('user', 'assign_page', 'service_id');

        return view('webbase/content', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = Admin_user_logic::get_user();

        $role_list = Role_logic::get_active_role();
 
        $assign_page = "admin_user/admin_input";

        $data = compact('user', 'role_list', 'assign_page');

        return view('webbase/content', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (!empty($_POST["user_id"])) 
        {
            
            // user

            $data = Admin_user_logic::update_format( $_POST );

            $user_id = intval($_POST["user_id"]);

            Admin_user_logic::edit_user( $data, $user_id );

            // user role delete add

            Admin_user_logic::delete_user_role( $user_id );

            Redis_tool::del_user_role( $user_id );

            $data = Admin_user_logic::add_user_role_format( $user_id, $_POST["auth"] );

            Admin_user_logic::add_user_role( $data );

        }
        else
        {
            // user

            $data = Admin_user_logic::insert_format( $_POST );
         
            $user_id = Admin_user_logic::add_user( $data );

            // user role add

            $data = Admin_user_logic::add_user_role_format( $user_id, $_POST["auth"] );

            Admin_user_logic::add_user_role( $data );

        }

        return redirect("/user");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {

        $_this = new self;

        $user = Admin_user_logic::get_user( $id );

        $user_role = $id > 0 ? Admin_user_logic::get_user_role_by_id( $id ) : "" ;

        $user_role = $_this->get_object_or_array_key( $user_role );

        $role_list = Role_logic::get_active_role();
 
        $assign_page = "admin_user/admin_input";

        $data = compact('user', 'role_list', 'user_role', 'assign_page');

        return view('webbase/content', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
