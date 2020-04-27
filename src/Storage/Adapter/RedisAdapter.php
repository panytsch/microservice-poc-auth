<?php

namespace App\Storage\Adapter;

use App\Storage\StorageAdapterInterface;
use App\Services\Redis\RedisHandlerInterface;

class RedisAdapter implements StorageAdapterInterface
{
    private RedisHandlerInterface $redisHandler;

    /**
     * @param RedisHandlerInterface $redisHandler
     */
    public function __construct(RedisHandlerInterface $redisHandler)
    {
        $this->redisHandler = $redisHandler;
    }

    /**
     * @param string $uniqKey
     * @param string $data
     */
    public function saveUser(string $uniqKey, string $data): void
    {
        $this->redisHandler->set($uniqKey, $data);
    }

    /**
     * @param string $uniqKey
     *
     * @return string|null
     */
    public function loadUser(string $uniqKey): ?array
    {
        return $this->redisHandler->exist($uniqKey)? json_decode($this->redisHandler->get($uniqKey), true) : null;
    }

    /**
     * @param string $uniqKey
     */
    public function remove(string $uniqKey): void
    {
        $this->redisHandler->del($uniqKey);
    }

    /**
     * @param string $uniqKey
     *
     * @return bool
     */
    public function exist(string $uniqKey): bool
    {
        return $this->redisHandler->exist($uniqKey);
    }
}