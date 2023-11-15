<?php

namespace App\Repositories\Write\User;

interface UserWriteRepositoryInterface
{
    public function upsert(array $data, array $firstNameData, array $emailData);
}
