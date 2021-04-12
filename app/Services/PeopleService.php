<?php

namespace App\Services;

use App\Exceptions\StoreFailException;
use App\Models\People;
use App\Constants\Error;
use Exception;
use Illuminate\Support\Facades\Log;

class PeopleService
{
    public function getWithPaginate($size = 15)
    {
        return People::paginate($size);
    }

    public function create($data)
    {
        try {
            return People::create($data);
        } catch (Exception $ex) {
            Log::error(__('Error :error fail to store people', [
                'error' => Error::PEOPLE_STORE_FAIL
            ]));

            throw new StoreFailException(__('Faild to create people'), Error::PEOPLE_STORE_FAIL, $ex);
        }
    }

    public function findOrFail($id)
    {
        return People::findOrFail($id);
    }

    public function update($id, $data)
    {
        return $this->findOrFail($id)->update($data);
    }
}