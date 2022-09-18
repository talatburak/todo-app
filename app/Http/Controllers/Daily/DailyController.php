<?php

namespace App\Http\Controllers\Daily;

use App\Http\Controllers\Controller;
use App\Models\Daily\Daily;
use App\Models\User\DayManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyController extends Controller {
    
    public function index(Request $request) {
        if(!Auth::check()) {
            return redirect()->route('index');
        }
        
    
        $userLastRecord = DayManager::where("user_id", Auth::id())->where("created_date", date("Y-m-d"))->first();
        
        $dayAlreadyStarted = false; 
        $dayFinished = false;
        if(!is_null($userLastRecord)) {
            if(is_null($userLastRecord->end_time)) {
                $dayAlreadyStarted = true;
            } else {
                $dayFinished = true;
            }
        }


        return view("default.daily.index", [
            "title" => "",
            "dayAlreadyStarted" => $dayAlreadyStarted,
            "dayFinished" => $dayFinished
        ]);
    }

    public function storage(Request $request) {

        $checkAjaxAndUser = $this->checkAjaxAndUser($request);
        if(isset($checkAjaxAndUser["status"])) {
            return response()->json([
                "status" => false,
                "message" => $checkAjaxAndUser["message"]
            ]);
        }
        

        try {

            $date = date("Y-m-d");
            $time = date("H:i");
            $addDaily = Daily::insertGetId([
                "user_id" => Auth::user()->id,
                "content" => $request->post("content"),
                "ipadress" => $request->ip(),
                "date" => $date,
                "daily_time" => $time
            ]);

            if($addDaily) {
                return response()->json([
                    "status" => true,
                    "date" => convertDateToReadable($date)." ".$time,
                    "content" => $request->post("content"),
                    "id" => $addDaily
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Bilinmedik bir hata oluştu"
                ]);
            }
            
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
            
        } 
        
    }

    public function list(Request $request) {
        
        $checkAjaxAndUser = $this->checkAjaxAndUser($request);

        if(isset($checkAjaxAndUser["status"])) {
            return response()->json($checkAjaxAndUser);
        }

        $dailys = Daily::where("user_id", "=", Auth::user()->id)
            ->where("date", "=", date("Y-m-d"))
            ->orderBy("dailyid", "desc")->get();
        return response()->json([
            "status" => true,
            "data" => $dailys
        ]);

        
    }
}
