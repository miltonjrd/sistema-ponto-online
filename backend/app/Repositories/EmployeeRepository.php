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
        return Employee::select([
            'employees.id',
            'employees.name',
            'employees.age',
            'm.name AS manager_name',
            'r.title AS role'
        ])->join('admins AS m', 'm.id', 'employees.manager_id')
        ->join('roles AS r', 'r.id', 'employees.role_id')
        ->get();
    }

    public function listById(int $id): Employee {
        return Employee::where('id', $id)->first();
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