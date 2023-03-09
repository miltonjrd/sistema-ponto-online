<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ClockedInRepositoryContract extends RepositoryContract
{
    public function listAllWithEmployeeData(): Collection;
}