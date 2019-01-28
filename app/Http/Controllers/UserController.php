<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use DB;
use Auth;

class UserController extends Controller {


    function index() {
        return view('auth.login');
    }

    function login(Request $request) {
        $user = DB::table('user')->where([
            ['email', '=', $_POST['email']],
        ])->first()
        ;
        if (password_verify($_POST['password'], $user->password)) {
            Auth::loginUsingId($user->id, false);
        } else {
            return view('auth.login')->with('errors', ['password', 'PassWord is wrong']);
        };
    }

    function register() {
        return view('auth.register');
    }

    function create(Request $request) {

        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'post' => 'required|numeric',
            'email' => 'required|email|unique:user',
            'phone' => 'required|numeric|digits:11',
            'password' => 'required|confirmed'
        ]);


        $User = new User();
        $User->name = $_POST['first_name'] . ' ' . $_POST['last_name'];
        $User->email = $_POST['email'];
        $User->genre = strtoupper($_POST['genre']);
        $User->password = bcrypt($_POST['password']);
        $User->phone = $_POST['phone'];
        $User->postId = $_POST['post'];
        $User->slug = "";

        $User->save();

        return redirect('/user/login')->with('status', 'ثبت نام شما کامل شد.');
    }
}
