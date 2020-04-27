<?php

namespace App\Services\Redis;

interface RedisHandlerInterface
{
    /**
     * @param string $uniqKey
     * @param string $data
     */
    public function set(string $uniqKey, string $data): void;

    /**
     * @param string $uniqKey
     *
     * @return string|null
     */
    public function get(string $uniqKey): ?string;

    /**
     * @param string $uniqKey
     */
    public function del(string $uniqKey): void;

    /**
     * @param string $uniqKey
     *
     * @return bool
     */
    public function exist(string $uniqKey): bool;
}