<?php

namespace App\Services\Authorise;

interface AuthorisableInterface
{
    public function getAuthInfo(): int;

    public function isAuthorisedIn(int $type): bool;

    public function authoriseIn(int $type): void;

    public function unAuthoriseIn(int $type): void;
}