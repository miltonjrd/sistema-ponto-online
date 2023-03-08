<?php

namespace App\Contracts;

interface RepositoryContract
{
    public function listAll(): array;
    public function create($data): bool;
    public function update(int $id, $data): bool;
    public function delete(int $id): bool;
}