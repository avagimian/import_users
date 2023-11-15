<?php

namespace App\Console\Commands;

use App\Jobs\User\CompleteImportHandlerJob;
use App\Jobs\User\UpdateOrInsertUsersHandlerJob;
use App\Models\Import;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Write\Import\ImportUserWriteRepositoryInterface;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Throwable;

class ImportUsersCommand extends Command
{
    private ?int $importId;

    protected $signature = 'import:users {importId}';

    protected $description = 'Import users';

    public const DATA_URL = 'https://randomuser.me/api/?results=5000';

    /**
     * @throws Throwable
     */
    public function handle(
        UserReadRepositoryInterface $userReadRepository
    ): void
    {
        try {
            $data = collect(json_decode(file_get_contents(self::DATA_URL), true))->first();

            $this->importId = $this->argument('importId');

            $insertedData = collect($data)->map(function ($item) use (&$fullNames) {
                $firstname = $item['name']['first'];
                $lastname = $item['name']['last'];

                return [
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'full_name' => $firstname . ' ' . $lastname,
                    'email' => $item['email'],
                    'age' => $item['dob']['age'],
                ];
            });

            $fullNames = $insertedData->pluck('full_name')->toArray();

            $existsUsersCount = $userReadRepository->getFullNamesCount($fullNames);

            $chunks = $insertedData->chunk(500);

            $jobs = [];

            foreach ($chunks as $chunk) {
                $cacheId = Str::uuid()->toString();

                Cache::set($cacheId, $chunk->toArray());

                $jobs[] = new UpdateOrInsertUsersHandlerJob($cacheId);
            }

            $importId = $this->importId;

            Bus::batch($jobs)
                ->then(function (Batch $batch) use ($existsUsersCount, $importId) {
                    CompleteImportHandlerJob::dispatch($existsUsersCount, $importId);
                })
                ->catch(function (Batch $batch, Throwable $exception) {
                    throw $exception;
                })
                ->dispatch();
        } catch (Throwable $exception) {
            $this->changeImportStatusToError($exception->getMessage());

            throw $exception;
        }
    }

    private function changeImportStatusToError(string $errorMessage): void
    {
        $data = [
            'status' => Import::ERROR,
            'type' => Import::USER_TYPE,
            'error_message' => $errorMessage,
        ];

        $importUserWriteRepository = resolve(ImportUserWriteRepositoryInterface::class);
        $importUserWriteRepository->update($this->importId, $data);
    }
}
