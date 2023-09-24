<?php

namespace App\Exceptions;

use ErrorException;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        /**
         * 1- REPORTAR: Erros na execução de queries do BD.
         * Parâmetro stop é para evitar as linhas adicionais dos erros.
         */
        $this->reportable(function (QueryException $exception) {
            $msg_base = '## QUERY_EXCEPTION ## ';
            Log::warning($msg_base . 'CODE: ' . $exception->getCode() . ' || MESSAGE: ' . $exception->getMessage());
        })->stop();

        // RENDERIZAR: Chama Página de erros 500 => falha na execução de queries ou falha na conexão com BD.
        $this->renderable(function(QueryException $exception) {
            return Inertia::render('Error/500',[
                'title'=> 'Falha no sistema',
                'message'=> $exception->getMessage(),
            ]);
        });

        /**
         * 2- REPORTAR: Erros na execução de códigos.
         * Parâmetro stop é para evitar as linhas adicionais dos erros.
         */
        $this->reportable(function(ErrorException $exception) {
            $msg_base = '## ERROR_EXCEPTION ## ';
            Log::warning($msg_base . 'CODE: ' . $exception->getCode() . ' || MESSAGE: ' . $exception->getMessage());
         })->stop();
        

        // RENDERIZAR: Página de erros 500 => erro na execução de instruções no servidor.
        $this->renderable(function(ErrorException $exception) {
            return Inertia::render('Error/500',[
                'title'=> 'Falha no sistema',
                'message'=> $exception->getMessage(),
            ]);
        });


        
        // REPORTAR: Erros na execução de rotas, caminho desconhecido.
        $this->renderable(function (NotFoundHttpException $exception) {
            $msg_base = '## NOT_FOUND ## ';
            Log::info($msg_base . 'CODE: ' . $exception->getCode(). ' || STATUS_CODE: ' . $exception->getStatusCode()   . ' || MESSAGE: ' . $exception->getMessage());
            // RENDERIZAR: Página de erros 404 => rota não encontrada ou registro não localizado no Model.
            return Inertia::render('Error/404', [
                'title' => 'Página não encontrada',
                'message' => $exception->getMessage(),
            ]);
        });

        // REPORTAR: Erros na execução métodos HTTP.
        $this->renderable(function (MethodNotAllowedHttpException $exception) {
            $msg_base = '## METHOD_NOT_ALLOWED ## ';
            Log::info($msg_base . 'CODE: ' . $exception->getCode(). ' || STATUS_CODE: ' . $exception->getStatusCode()   . ' || MESSAGE: ' . $exception->getMessage());
            // RENDERIZAR: Página de erros 405 => Método não suportado na URL passada.
            return Inertia::render('Error/405', [
                'title' => 'Erro no método',
                'message' => $exception->getMessage(),
            ]);
        });

        // REPORTAR: Erros na execução de rotas, caminho não permitido a esse usuário.
        $this->renderable(function (AccessDeniedHttpException $exception) {
            $msg_base = '## NOT_AUTHORIZATION ## ';
            Log::info($msg_base . 'CODE: ' . $exception->getCode(). ' || STATUS_CODE: ' . $exception->getStatusCode()   . ' || MESSAGE: ' . $exception->getMessage());
            // Renderizar Página de erros 405 => acesso não autorizado para o usuário.
            return Inertia::render('Error/405', [
                'title' => 'Ação não autorizada',
                'message' => $exception->getMessage(),
            ]);
        });

        // REPORTAR: Qualquer exceções.
        /* $this->renderable(function(Exception $exception) {
            $msg_base = 'EXCEPTION|| ';
            Log::error($msg_base . 'STATUS_CODE: '.$exception->getPrevious() . ' CODE: ' . $exception->getCode() . ' MESSAGE: ' . $exception->getMessage());
            dd('exception general',$exception);
        }); */
    }
}
