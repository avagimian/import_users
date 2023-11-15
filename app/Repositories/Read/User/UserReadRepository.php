<?php

namespace App\Repositories\Read\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserReadRepository implements UserReadRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function getCount(): int
    {
        return $this->query()->count();
    }

    public function getFullNamesCount(array $fullNames): int
    {
        return $this->query()->whereIn('full_name', $fullNames)->count();
    }
}
