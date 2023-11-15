<?php

namespace App\Repositories\Write\Import;

use App\Models\Import;

interface ImportUserWriteRepositoryInterface
{
    public function save(Import $import);

    public function update(int $importId, array $data);
}
