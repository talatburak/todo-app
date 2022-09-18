<?php

namespace App\Http\Controllers\User;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Controller;
use App\Models\User\DayManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DayController extends Controller
{
    //

    public function start(Request $request) {
        if(!$this->checkAjaxAndUser($request)) {
            return false;
        }

        try {
            $todayDate = date("Y-m-d");
            $userId = Auth::id();

            $startDay = DayManager::where("user_id", $userId)
                ->where("created_date", $todayDate)
                ->first();
            
            if(!is_null($startDay)) {
                return response()->json([
                    "status" => false,
                    "message" => "Günü zaten bir kere başlatmışsın, hayırdır"
                ]);
            }

            DayManager::create([
                "user_id" => $userId,
                "created_date" => $todayDate,
                "start_time" => date("H:i"),
                "year" => date("Y"),
                "mounth" => date("m")
            ]);

            return [
                "status" => true,
                "message" => "Günü başlattın reisim, yolun açık olsun"
            ];
        } catch(Exception $e) {
            throw new DatabaseException($e->getMessage());
        }
    }

    public function end(Request $request) {

        if(!$this->checkAjaxAndUser($request)) {
            return false;
        }

        try {

            $userId = Auth::id();
            $todayDate = date("Y-m-d");
            
            $startDay = DayManager::where("user_id", $userId)
                ->where("created_date", $todayDate)
                ->first();

            if(!is_null($startDay)) {

                if(!is_null($startDay->end_time)) {
                    return response()->json([
                        "status" => false,
                        "message" => "Günü zaten bitirmişsin moruk, zorlama evine git"
                    ]);
                }

                $startDay = DayManager::where("user_id", $userId)
                ->where("created_date", $todayDate)
                ->update([
                    "end_time" => date("H:i")
                ]);
                
                return [
                    "status" => true,
                    "message" => "Günü başarıyla sonlandırdın"
                ];    
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Günü daha başlatmamışsın ki bitiresin"
                ]);
            }
            
        } catch(Exception $e) {
            throw new DatabaseException($e->getMessage());
        }
    }
}
