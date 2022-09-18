<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {



    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            
            return response()->json([
                "status" => true,
                "message" => "Başarıyla giriş yaptınız"
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Kullanıcı adı veya şifre yanlış"
            ]);
        }
    }
}
