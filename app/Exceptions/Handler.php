<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($e->getCode() == 500 || $e instanceof QueryException) {
                // Invalida la sesión manualmente sin acceder a la base de datos
                Session::flush(); // Limpia todos los datos de la sesión
                return response()->view('page.500', [], 500); // Redirige a la página 500
            }

            return null; // Deja que el manejo de errores continúe normalmente
        });
    }
}
