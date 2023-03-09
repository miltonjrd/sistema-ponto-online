<?php

namespace App\Exceptions;
use App\Exceptions\ResponseException;

class NotFoundResponseException extends ResponseException
{
    
	/**
	 * @return string
	 */
	protected function message(): string 
    {
        return 'Recurso não encontrado.';
	}
	
	/**
	 * @return string
	 */
	protected function error(): string 
    {
        return 'Not found.';
	}
	
	/**
	 * @return int
	 */
	protected function status(): int 
    {
        return 404;
	}

    public function __construct()
    {
        parent::render();
    }
}