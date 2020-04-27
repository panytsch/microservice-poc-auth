<?php

namespace App\Services\Redis;

use Redis;

class Handler implements RedisHandlerInterface
{
    private const TTL = 10000;

    private Redis $connection;

    /**
     * RedisHandler constructor.
     *
     * @param Redis $connection
     */
    public function __construct(Redis $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $uniqId
     * @param string $data
     */
    public function set(string $uniqId, string $data): void
    {
        $this->connection->set($uniqId, $data, ['EX' => static::TTL]);
    }

    /**
     * @param string $uniqId
     *
     * @return string|null
     */
    public function get(string $uniqId): ?string
    {
        return $this->connection->get($uniqId);
    }

    /**
     * @param string $uniqId
     */
    public function del(string $uniqId): void
    {
        $this->connection->del($uniqId);
    }

    public function exist(string $uniqKey): bool
    {
        return $this->connection->exists($uniqKey);
    }
}