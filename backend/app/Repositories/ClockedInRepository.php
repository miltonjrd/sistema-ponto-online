<?php

namespace App\Repositories;

use App\Contracts\ClockedInRepositoryContract;
use App\Models\ClockedIn;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ClockedInRepository implements ClockedInRepositoryContract
{
    public function __construct() {}

    /**
     * @return Collection
     */
    public function listAll(): Collection
    {
        return ClockedIn::all();
    }

    /**
     * @return array
     */
    public function listAllWithEmployeeData($filterDateStart = null, $filterDateEnd = null): array
    {
        // $results = ClockedIn::select([
        //     DB::raw('e.id AS id'),
        //     DB::raw('e.name AS employee_name'),
        //     DB::raw('r.title AS role'),
        //     'e.age',
        //     'e.manager_name',
        //     'clocked_in.created_at'
        // ])->join('employees AS e', 'id', 'clocked_in.employee_id')
        // ->join('roles AS r', 'id', 'c.role_id')
        // ->get();

        $sql = "SELECT e.id, e.name AS employee_name, r.title AS role, e.age, e.manager_name, clocked_in.created_at
            FROM clocked_in
            INNER JOIN employees AS e
            ON e.id = clocked_in.employee_id
            INNER JOIN roles AS r
            ON r.id = e.role_id
        ";

        // in case of filters being especified, concat it to the query
        if ($filterDateStart) {
            $sql += " WHERE clocked_in.created_at >= :filterDateStart";
        }

        if ($filterDateEnd) {
            $sql += " AND clocked_in.created_at <= :filterDateEnd";
        }

        $sql += " ORDER BY clocked_in.created_at DESC";

        $results = DB::select($sql, [
            'filterDateStart' => $filterDateStart,
            'filterDateEnd' => $filterDateEnd
        ]);

        return $results;
    }

    /**
     * @return bool
     */
    public function create($data): bool
    {
        $clockedIn = ClockedIn::create($data);
        return !!$clockedIn;
    }
	/**
	 * @return bool
	 */
	public function update(int $id, $data): bool 
    {
        return false;
	}
	
	/**
	 * @return bool
	 */
	public function delete(int $id): bool 
    {
        return false;
	}
}