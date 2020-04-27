<?php

namespace App\Services\Authorise;

use App\Storage\StorageAdapterInterface;

class ServicesAuthorise
{
    /**
     * @var StorageAdapterInterface
     */
    private StorageAdapterInterface $servicesStorageAdapter;

    public function __construct(StorageAdapterInterface $servicesStorageAdapter)
    {
        $this->servicesStorageAdapter = $servicesStorageAdapter;
    }

    public function getUserData($name, $pass, $net, $skin): ?array
    {
        $this->servicesStorageAdapter->loadUser();
    }
}