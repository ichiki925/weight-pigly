<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;


class RegisterController extends Controller
{
     // STEP1: アカウント情報登録フォーム
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function storeRegisterForm(Request $request)
    {
        // 入力バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);

        // データ保存
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 自動ログイン
        Auth::login($user);

        // register2にリダイレクト
        return redirect()->route('register2.show');
    }

    // STEP2: 体重情報入力フォーム
    public function showRegister2Form()
    {
        return view('auth.register2');
    }

    // public function storeRegister2Form(Request $request)
    // {


    //     // 現在ログイン中のユーザーに関連付けて保存
    //     $user = Auth::user();
    //     $user->weightTarget()->create([
    //         'target_weight' => $request->target_weight,
    //     ]);

    //     // 体重管理ページにリダイレクト
    //     return redirect()->route('weight_logs');
    // }

    public function register(RegisterRequest $request)
    {
    // バリデーションがここで実行されます
        $validated = $request->validated();

    // 登録処理など
    }

}


