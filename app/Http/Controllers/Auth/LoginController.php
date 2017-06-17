<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\logistics\Verifycode;
use Illuminate\Support\Facades\Session;
use App\logistics\Login;
use App\logistics\Redis_tool;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {

        Verifycode::get_verify_code();

        $Verifycode = Session::get('Verifycode');

        $Verifycode_img = Session::get('Verifycode_img');

        $ErrorMsg = Session::get('ErrorMsg');

        return view('login', compact("Verifycode_img", "ErrorMsg"));
    
    }


    public function process()
    {

        $result = array();

        $data = Login::login_format($_POST);

        $result = Login::login_verify($data);

        return empty($result) ? redirect("/index") : back()->with('ErrorMsg', $result);

    }

    public function logout()
    {

        Login::logout();

        return redirect("/login");

    }

    public function refresh()
    {

        Session::forget('Verifycode');

        Session::forget('Verifycode_img');

        Verifycode::get_verify_code();

        $Verifycode_img = Session::get('Verifycode_img');

        return $Verifycode_img;

    }

}
