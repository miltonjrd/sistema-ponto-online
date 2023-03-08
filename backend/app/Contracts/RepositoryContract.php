<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface RepositoryContract
{
    public function listAll(): Collection;
    public function create($data): bool;
    public function update(int $id, $data): bool;
    public function delete(int $id): bool;
}