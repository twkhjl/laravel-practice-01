<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],

        ], [], [
            'name' => '用戶名稱',
            'password' => '密碼',
        ]);

        // dd($request->input());


        // 取得表單輸入值
        $user = new User();
        $fillable = collect($user->getFillable())->toArray();
        $formField = $request->only($fillable);

        $formField['password'] = bcrypt($request->input('password'));
        // $formField['password']=Hash::make($request->input('password'));

        $user = $user->create($formField);

        auth()->login($user);
        // Auth::login($user);

        return redirect(route('listings.index'))->with('message', '註冊成功');
    }

    public function logout(Request $request){


        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return redirect(route('listings.index'))->with('message', '已成功登出');

    }

    public function login(){
        return view('users.login');

    }

    public function authenticate(Request $request){

        $formField['email']=$request->input('email');
        $formField['password']=$request->input('password');

        if(auth()->attempt($formField)){

            $request->session()->regenerate();
            return redirect(route('listings.index'))->with('message', '成功登入');
        }

        return back()->withErrors([
            'email'=>'郵箱或密碼錯誤'
            ])->onlyInput();

    }
}
