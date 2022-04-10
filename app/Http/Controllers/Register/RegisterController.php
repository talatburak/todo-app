<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller {
    

    public function index() {

        if(Auth::check()) {
            return redirect()->route("index");
        }

        return view("default.register.register");
    }

    public function store(Request $request) {
        if($request->ajax()) {

            if(Auth::check()) {

                return response()->json([
                    'status' => false,
                    'message' => "Zaten kayıtlısınız",
                ]);

            } else {
                
                $count = User::where("email", $request->email)->count();
                if($count > 0) {
                    return response()->json([
                        'status' => false,
                        'message' => "Bu e-mail zaten kayıtlı."
                    ]);
                }


                if(!$request->has("terms")) {
                    return response()->json([
                        "status" => false,
                        "message" => "Lütfen kullanıcı sözleşmesini kabul edin. Aksi halde kayıt olamazsınız"
                    ]);
                }

                try {
                    $dumb = User::insert([
                        "username" => $request->input("username"),
                        "email" => $request->input("email"),
                        "password" => Hash::make($request->input("password"))
                    ]);

                    if($dumb) {

                        $credentials = $request->validate([
                            'email' => ['required', 'email'],
                            'password' => ['required'],
                        ]);
                        
                        Auth::attempt($credentials);

                        return response()->json([
                            'status' => true,
                            'message' => "Başarı ile kayıt oldunuz",
                        ]);
                    } else {
                        return response()->json([
                            "status" => false,
                            "message" => "Bilinmedik bir hata oluştu"
                        ]);
                    }
                } catch(Exception $a) {
                    // echo $a->getMessage();
                    return response()->json([
                        "status" => false,
                        "rawmessage" => $a->getMessage(),
                        "message" => "Bilinmedik bir hata oluştu. Lütfen daha sonra tekrar deneyiniz."
                    ]);
                }
                
            }
        }
    }
}
