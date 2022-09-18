<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthException;
use App\Exceptions\NotAjaxRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController {
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function checkAjaxAndUser(HttpRequest $request) {
        if(!$request->ajax()) {
            throw new NotAjaxRequest("Lütfen gönderilen parametreyi kontrol ediniz.");
            return false;
        }

        if(!Auth::check()) {
            throw new AuthException("Lütfen gönderilen parametreyi kontrol ediniz.");
            return false;
        }

        return true;
    }
}
