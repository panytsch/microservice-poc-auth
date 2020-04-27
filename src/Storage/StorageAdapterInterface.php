<?php

namespace App\Storage;

use App\Services\Authorise\UserInterface;

interface StorageAdapterInterface
{
    public function saveUser(string $uniqKey, string $data): void;

    public function loadUser(string $uniqKey): ?array;

    public function remove(string $uniqKey): void;

    public function exist(string $uniqKey): bool;
}