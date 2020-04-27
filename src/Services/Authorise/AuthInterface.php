<?php

namespace App\Services\Authorise;

interface AuthInterface
{
    public function authorise(BaseUserInterface $user): ?string;

    public function unAuthorise(BaseUserInterface $user): void;
}