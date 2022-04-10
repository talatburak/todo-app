<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskHandler extends Controller
{

    public function __construct() {
        
    }

    public function index(Request $request) {
        if(!Auth::check()) {
            return redirect()->route('index');
        }
        
    }

    public function create(Request $request) {
        
        if(!Auth::check()) {
            return redirect()->route("index");
        }

        return view("default.task.create");
    }

    public function storage(Request $request) {
        if($request->ajax()) {
            if(!Auth::check()) {
                return response()->json([
                    "callback" => true,
                    "login" => false,
                    "message" => "Oturumunuz sonlanmış, lütfen sayfayı yenileyiniz."
                ]);
            }
            $user = Auth::user();
            // print_r(Auth::user());
            $create = Tasks::create([
                "task_name" => $request->gorev_basligi,
                "task_desc" => $request->gorev_kisa,
                "creator_id" => $user->id,
                ""
            ]);
        }

        return response()->json([
            "callback" => false,
            "message" => "Erişim engeliniz var"
        ]);
    }
}
