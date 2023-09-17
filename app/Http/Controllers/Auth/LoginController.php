<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // // dd($request);
        // if ($request->db_connection == "LB") {
        //     Session::put('dbName', 'sap-proj-LB');
        // } else {
        //     Session::put('dbName', 'sap-proj-TM');
        // }
    }
}



// file_put_contents(app()->environmentFilePath(), str_replace(
//     "DB_DATABASE" . '=' . env("DB_DATABASE"),
//     "DB_DATABASE" . '=' . "sap-proj-LB",
//     file_get_contents(app()->environmentFilePath())
// ));


// file_put_contents(app()->environmentFilePath(), str_replace(
//     "DB_DATABASE" . '=' .env("DB_DATABASE"),
//     "DB_DATABASE" . '=' . "sap-proj-TM",
//     file_get_contents(app()->environmentFilePath())
// ));