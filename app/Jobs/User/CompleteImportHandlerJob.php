<?php

namespace App\Jobs\User;

use App\Consts\StatusConsts;
use App\Jobs\HandlerJob;
use App\Models\Import;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Write\Import\ImportUserWriteRepositoryInterface;

class CompleteImportHandlerJob extends HandlerJob
{
    public function __construct(
        private int $existsUsersCount,
        private int $importId,
    ) {
    }

    public function handle(
        UserReadRepositoryInterface $userReadRepository,
        ImportUserWriteRepositoryInterface $importUserWriteRepository
    ): void {
        $allUsersCount = $userReadRepository->getCount();
        $newUsersCount = $allUsersCount - $this->existsUsersCount;

        $data = [
            'all_counts' => $allUsersCount,
            'new_counts' => $newUsersCount,
            'exists_counts' => $this->existsUsersCount,
            'status' => Import::SUCCESS,
            'type' => Import::USER_TYPE,
        ];

        $importUserWriteRepository->update($this->importId, $data);
    }
}
