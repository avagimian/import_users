<?php

namespace App\Repositories\Write\Import;

use App\Exceptions\SavingErrorException;
use App\Models\Import;
use Illuminate\Database\Eloquent\Builder;

class ImportUserWriteRepository implements ImportUserWriteRepositoryInterface
{
    private function query(): Builder
    {
        return Import::query();
    }

    /**
     * @throws SavingErrorException
     */
    public function save(Import $import): bool
    {
        if (!$import->save()) {
            throw new SavingErrorException();
        }

        return true;
    }

    public function update(int $importId, array $data): int
    {
        return $this->query()
            ->where('id', $importId)
            ->update($data);
    }
}
