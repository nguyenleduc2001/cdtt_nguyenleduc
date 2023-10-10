<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getlogin()
    {
        return view("backend.Account.login");
    }
    public function postLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $data = array('password' => $password, 'roles' => 1);
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $username;
        } else {
            $data['username'] = $username;
        }
        if (Auth::attempt($data)) {
            return redirect()->route('dashboard.index');
        }
        $error = 'Tài khoản đăng nhập không hợp lệ';
        return view('backend.Account.login', compact("error"));
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
?>