<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->renderable(function(NotAjaxRequest $e, $request) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        });

        $this->renderable(function(AuthException $e, $request) {
            return response()->json([
                "status" => false,
                "message" => "Yetkilendirme başarısız, lütfen tekrar giriş yapınız."
            ]);
        });

        $this->renderable(function(DatabaseException $e, $request) {
            return response()->json([
                "status" => false,
                "message" => "Veri eklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyiniz.."
            ]);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
