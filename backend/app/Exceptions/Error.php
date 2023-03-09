<?php

namespace App\Exceptions;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class Error implements Jsonable, Arrayable, JsonSerializable
{
    private $error_code;
    private $message;

    public function __construct($error_code, $message)
    {
        $this->error_code = $error_code;
        $this->message = $message;
    }

	/**
	 * Convert the object to its JSON representation.
	 *
	 * @param int $options
	 * @return string
	 */
	public function toJson($options = 0) 
    {
        $encoded = json_encode($this->jsonSerialize(), $options);
        throw_unless($encoded, JsonEncodeException::class);
        return $encoded;
	}
	
	/**
	 * Get the instance as an array.
	 * @return array
	 */
	public function toArray() 
    {
        return [
            'statusCode' => $this->error_code,
            'message' => $this->message
        ];
	}
	
	/**
	 * Specify data which should be serialized to JSON
	 * Serializes the object to a value that can be serialized natively by json_encode().
	 * @return mixed Returns data which can be serialized by json_encode(), which is a value of any type other than a resource .
	 */
	public function jsonSerialize() 
    {
        return $this->toArray();
	}
}