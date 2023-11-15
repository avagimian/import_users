<?php

namespace App\Repositories\Write\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserWriteRepository implements UserWriteRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function upsert(array $data, array $firstNameData, array $emailData): int
    {
        return $this->query()->upsert($data, $firstNameData, $emailData);
    }
}
