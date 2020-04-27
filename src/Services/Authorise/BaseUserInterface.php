<?php

namespace App\Services\Authorise;

interface BaseUserInterface
{
    public function getName(): string;
    public function getPass(): string;
    public function getNet(): int;
    public function getSkin(): int;
}