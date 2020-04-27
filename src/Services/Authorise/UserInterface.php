<?php

namespace App\Services\Authorise;

/**
 * Interface UserInterface
 * @package App\Services\Authorise
 */
interface UserInterface extends BaseUserInterface, AuthorisableInterface
{
    public const BASE_DATA = 1;
    public const SERVICES_DATA = 2;
    public const REDIS_DATA = 4;
    public const DB_DATA = 8;

    public const FULL_DATA = 127;

    public const TYPES = [
        self::BASE_DATA,
        self::SERVICES_DATA,
        self::REDIS_DATA,
        self::DB_DATA,
    ];

    public function setAdditionalData(int $type, array $data): void;

    public function get(int $type, string $field = null): array;
}