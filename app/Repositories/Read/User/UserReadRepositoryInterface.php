<?php

namespace App\Repositories\Read\User;

interface UserReadRepositoryInterface
{
    public function getCount(): int;

    public function getFullNamesCount(array $fullNames): int;
}
