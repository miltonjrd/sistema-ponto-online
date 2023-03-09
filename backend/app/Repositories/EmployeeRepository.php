<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository implements RepositoryContract 
{
    public function __construct() {}
    /**
     * @return Collection
     */
    public function listAll(): Collection {
        return Employee::all();
    }

    /**
     * @return bool;
     */
    public function create($data): bool {
        $customer = Employee::create($data);
        return !!$customer;
    }

    /**
     * @return bool;
     */
    public function update(int $id, $data): bool {
        $customer = Employee::where('id', $id)->first();
        $result = $customer->update($data);
        return !!$result;
    }

    /**
     * @return bool;
     */
    public function delete(int $id): bool {
        $result = Employee::where('id', $id)->delete();
        return !!$result;
    }
}