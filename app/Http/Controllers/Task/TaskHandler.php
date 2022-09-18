<?php

namespace App\Http\Controllers\Task;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Models\Task\Tasks;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskHandler extends Controller
{

    private $limit = 3;

    public function __construct() {
        
    }

    public function index(Request $request) {
        if(!Auth::check()) {
            return redirect()->route('index');
        }

        $data = Tasks::where("creator_id", "=", Auth::id())->orderBy("task_id", "desc")->cursorPaginate($this->limit)->toArray();
        return view("default.task.list", [
            "data" => $data
        ]);
    }

    public function create(Request $request) {
        
        if(!Auth::check()) {
            return redirect()->route("index");
        }

        return view("default.task.create");
    }

    public function storage(Request $request) {
        if(!$this->checkAjaxAndUser($request)) {
            return false;
        }   

        try {
            $user = Auth::user();
            $mergedVariables = [];
            if(!$request->has("sure_yok")) {
                $mergedVariables["sure_yok"] = 0;
            } else {
                $mergedVariables["sure_yok"] = 1;
            }

            if(!$request->has("bitistarihi") || !$request->filled("bitistarihi")) {
                $mergedVariables["bitistarihi"] = null;
            }

            if(!empty($mergedVariables)) {
                $request->merge($mergedVariables);
            }
            // print_r(Auth::user());
            $create = Tasks::create([
                "task_name" => $request->gorev_basligi,
                "task_desc" => $request->gorev_kisa,
                "creator_id" => $user->id,
                "unlimited" => $request->sure_yok,
                "done_date" => $request->bitistarihi
            ]);
            
            return response()->json([
                "status" => true,
                "message" => "Görev başarı ile kaydedildi.",
                "blkodu" => $create->task_id
            ]);
            
        } catch(Exception $e) {
            throw new DatabaseException($e->getMessage());
        }

        return response()->json([
            "callback" => false,
            "message" => "Erişim engeliniz var"
        ]);
    }

    public function list(Request $request) {
        if(!$this->checkAjaxAndUser($request)) {
            return false;
        }
        
        $tasks = Tasks::where("creator_id", "=", Auth::id())->orderBy("task_id", "desc")->cursorPaginate(3)->toArray();
        print_r($tasks);
    }
}
