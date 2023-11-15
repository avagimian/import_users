<?php

namespace App\Services\User\Actions;

use App\Models\Import;
use App\Repositories\Write\Import\ImportUserWriteRepositoryInterface;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class ImportUsersActions
{
    public function __construct(
        protected ImportUserWriteRepositoryInterface $importUserWriteRepository
    ) {
    }

    /**
     * @throws Throwable
     */
    public function run(): int
    {
        try {
            $import = Import::create(
                Import::USER_TYPE,
                Import::IN_PROGRESS
            );

            $this->importUserWriteRepository->save($import);

            Artisan::call('import:users', ['importId' => $import->id]);

            return $import->id;

        } catch (Throwable $exception) {
            throw new $exception;
        }
    }
}
