<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\logistics\Role_logistics;
use App\logistics\Service_logistics;
use App\logistics\Redis_tool;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // get now page

        Service_logistics::get_service_id_by_url_and_save( $request->path() );

        // search bar setting

        $search_tool = array(5,6);

        Redis_tool::set_search_tool( $search_tool );

        $role = Role_logistics::get_role_list( $_GET );
 
        $assign_page = "role/role_list";

        $data = compact('role', 'assign_page');

        return view('webbase/content', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $role = "";
 
        $assign_page = "role/role_input";

        $menu_data = Service_logistics::get_active_service();

        $menu_list = Service_logistics::menu_format( $menu_data );

        $data = compact('role', 'assign_page', 'menu_list');

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

        if (!empty($_POST["role_id"])) 
        {
            
            // role

            $data = Role_logistics::update_format( $_POST );

            $role_id = intval($_POST["role_id"]);

            Role_logistics::edit_role( $data, $role_id );

            // role service delete add

            Role_logistics::delete_role_service( $role_id ) ;

            if (!empty($_POST["auth"])) 
            {
                $data = Role_logistics::add_role_service_format( $role_id, 0, $_POST["auth"] );

                Role_logistics::add_role_service( $data );
            }

        }
        else
        {
            // role

            $data = Role_logistics::insert_format( $_POST );
         
            $role_id = Role_logistics::add_role( $data );

            // role service add
            
            if (!empty($_POST["auth"])) 
            {
                $data = Role_logistics::add_role_service_format( $role_id, 0, $_POST["auth"] );

                $data = Role_logistics::add_role_service( $data );
            }

        }

        return redirect("/role");

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

        $role = Role_logistics::get_role( $id );
 
        $assign_page = "role/role_input";

        $menu_data = Service_logistics::get_active_service();

        $menu_list = Service_logistics::menu_format( $menu_data );

        $role_service_data = Role_logistics::get_role_service( $id );

        $role_service = Service_logistics::role_auth_format( $role_service_data );

        $data = compact('role', 'assign_page', 'menu_list', 'role_service');

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        //
    }
}
