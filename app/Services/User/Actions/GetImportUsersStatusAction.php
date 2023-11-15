<?php

namespace App\Services\User\Actions;

use App\Http\Resources\User\ImportResource;
use App\Repositories\Read\Import\ImportUserReadRepositoryInterface;

class GetImportUsersStatusAction
{
    public function __construct(
        protected ImportUserReadRepositoryInterface $importUserReadRepository
    ) {
    }

    public function run(int $importId): ImportResource
    {
        $import = $this->importUserReadRepository->findOrFail($importId);

        return ImportResource::make($import);
    }
}
