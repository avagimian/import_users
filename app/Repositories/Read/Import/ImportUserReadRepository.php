<?php

namespace App\Repositories\Read\Import;

use App\Exceptions\ImportDoesNotExistException;
use App\Models\Import;
use Illuminate\Database\Eloquent\Builder;

class ImportUserReadRepository implements ImportUserReadRepositoryInterface
{
    private function query(): Builder
    {
        return Import::query();
    }

    /**
     * @throws ImportDoesNotExistException
     */
    public function getLatest(): ?Import
    {
        return $this->query()
            ->orderByDesc('created_at')
            ->first();
    }

    public function findOrFail(int $importId)
    {
        return $this->query()->findOrFail($importId);
    }
}
