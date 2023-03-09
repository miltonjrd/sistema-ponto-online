<?php
namespace App\Exceptions;

use App\Exceptions\Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

abstract class ResponseException extends Exception 
{
    abstract protected function message(): string;
    abstract protected function error(): string;
    abstract protected function status(): int;

    public function render(): JsonResponse
    {
        $error = new Error($this->status(), $this->message());
        return response()->json($error->toArray(), $this->status());
    }
}
