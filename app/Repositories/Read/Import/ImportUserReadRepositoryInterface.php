<?php

namespace App\Repositories\Read\Import;

use App\Models\Import;

interface ImportUserReadRepositoryInterface
{
    public function getLatest(): ?Import;

    public function findOrFail(int $importId);
}
