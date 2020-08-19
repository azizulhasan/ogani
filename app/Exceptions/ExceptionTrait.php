<?php 
namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait{

    public function apiExceptions($request, $exception){
        if($exception instanceof ModelNotFoundException){
            return response()->json([
                'errors' => "Model Not Found"
            ],Response::HTTP_NOT_FOUND);
        }
            if($exception instanceof NotFoundHttpException){
                return response()->json([
                    'errors' => "Route Not Found"
                ],Response::HTTP_NOT_FOUND);
            }
        
    }
}
