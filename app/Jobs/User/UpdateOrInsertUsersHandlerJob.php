<?php

namespace App\Jobs\User;

use App\Exceptions\UpdateOrInsertUsersFailedException;
use App\Jobs\HandlerJob;
use App\Repositories\Write\User\UserWriteRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Throwable;

class UpdateOrInsertUsersHandlerJob extends HandlerJob
{
    public function __construct(private string $cacheId)
    {
    }

    /**
     * @throws UpdateOrInsertUsersFailedException
     */
    public function handle(
        UserWriteRepositoryInterface $userWriteRepository
    ): void {
        try {
            $data = Cache::get($this->cacheId);
            Cache::forget($this->cacheId);

            $userWriteRepository->upsert($data, ['first_name', 'last_name'], ['age', 'email']);
        } catch (Throwable $exception) {
            throw new UpdateOrInsertUsersFailedException($exception->getMessage());
        }
    }
}
