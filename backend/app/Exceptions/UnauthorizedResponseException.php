<?php

namespace App\Exceptions;
use App\Exceptions\ResponseException;

class UnauthorizedResponseException extends ResponseException
{
    
	/**
	 * @return string
	 */
	protected function message(): string 
    {
        return 'As credenciais fornecidas são inválidas.';
	}
	
	/**
	 * @return string
	 */
	protected function error(): string 
    {
        return 'Unauthorized.';
	}
	
	/**
	 * @return int
	 */
	protected function status(): int 
    {
        return 401;
	}
}