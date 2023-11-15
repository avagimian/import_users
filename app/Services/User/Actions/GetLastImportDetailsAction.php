<?php

namespace App\Services\User\Actions;

use App\Models\Import;
use App\Repositories\Read\Import\ImportUserReadRepositoryInterface;

class GetLastImportDetailsAction
{
    public function __construct(
        protected ImportUserReadRepositoryInterface $importUserReadRepository
    ) {
    }

    public function run(): ?Import
    {
        return $this->importUserReadRepository->getLatest();
    }
}
