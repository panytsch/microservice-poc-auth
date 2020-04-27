<?php

namespace App\Storage\Adapter;

use App\Exception\RestrictionException;
use App\Storage\StorageAdapterInterface;

class DbAdapter implements StorageAdapterInterface
{
    /**
     * @param string $uniqKey
     * @param string $data
     */
    public function saveUser(string $uniqKey, string $data): void
    {
        throw new RestrictionException('Your are not allowed to do this action.');
    }

    /**
     * @param string $uniqKey
     *
     * @return string|null
     */
    public function loadUser(string $uniqKey): ?array
    {
        /**
         * MOCKED USER DATA FROM DATABASE !!!!! name + pwd
         */
        return ['id' => 1, 'name' => 'some name from DB'];
    }

    /**
     * @param string $uniqKey
     */
    public function remove(string $uniqKey): void
    {
        throw new RestrictionException('Your are not allowed to do this action.');
    }

    /**
     * @param string $uniqKey
     *
     * @return bool
     */
    public function exist(string $uniqKey): bool
    {
        return true;
    }


}