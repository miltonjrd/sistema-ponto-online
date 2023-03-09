<?php

namespace App\Repositories;
use App\Contracts\RepositoryContract;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RepositoryContract
{
    public function __construct() {}

    /**
     * @return Collection<Role>
     */
    public function listAll(): Collection
    {
        return Role::all();
    }

    /**
     * @return bool
     */
    public function create($data): bool
    {
        $result = Role::create($data);
        return !!$result;
    }

    /**
     * @return bool
     */
    public function update(int $id, $data): bool
    {
        $customer = Role::where('id', $id)->first();
        $result = $customer->update($data);
        return !!$result;
    }

    /**
     * @return bool
     */
    public function delete(int $id): bool
    {
        $customer = Role::where('id', $id)->delete();
        return !!$customer;
    }
}