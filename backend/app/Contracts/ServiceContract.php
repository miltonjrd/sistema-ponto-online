<?php

namespace App\Contracts;

interface ServiceContract {
    public function execute(): mixed;
}