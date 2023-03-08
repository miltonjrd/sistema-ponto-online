<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements RepositoryContract 
{
    public function __construct() {}
    /**
     * @return Collection<Customer>
     */
    public function listAll(): Collection {
        return Customer::all();
    }

    /**
     * @return bool;
     */
    public function create($data): bool {
        $customer = Customer::create($data);
        return !!$customer;
    }

    /**
     * @return bool;
     */
    public function update(int $id, $data): bool {
        $customer = Customer::where('id', $id)->first();
        $result = $customer->update($data);
        return !!$result;
    }

    /**
     * @return bool;
     */
    public function delete(int $id): bool {
        $result = Customer::where('id', $id)->delete();
        return !!$result;
    }
}