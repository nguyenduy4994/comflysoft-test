<?php

namespace App\Services;

use App\Constants\Error;
use App\Exceptions\StoreFailException;
use App\Models\People;
use Exception;
use Illuminate\Support\Facades\Log;

class PeopleService
{
    /**
     * Get list of people with paginate.
     *
     * @param int $size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWithPaginate($size = 15)
    {
        return People::paginate($size);
    }

    /**
     * Create a person.
     *
     * @param int $personId
     * @param array $data
     * @return \App\Models\Point
     * @throws \App\Exceptions\StoreFailException
     */
    public function create($data)
    {
        try {
            return People::create($data);
        } catch (Exception $ex) {
            Log::error(__('Error :error fail to store people', [
                'error' => Error::PEOPLE_STORE_FAIL,
            ]));

            throw new StoreFailException(__('Faild to create people'), Error::PEOPLE_STORE_FAIL, $ex);
        }
    }

    /**
     * Find a person.
     *
     * @param int $id
     * @return \App\Models\People
     */
    public function findOrFail($id)
    {
        return People::findOrFail($id);
    }

    /**
     * Update a person.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        return $this->findOrFail($id)->update($data);
    }
}
