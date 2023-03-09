<?php

namespace App\Contracts;

use Illuminate\Support\Facades\Request;

interface ServiceContract {
    public function execute(Request $request): mixed;
}