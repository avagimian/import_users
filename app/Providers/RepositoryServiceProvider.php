<?php

namespace App\Providers;


use App\Repositories\Read\Import\ImportUserReadRepository;
use App\Repositories\Read\Import\ImportUserReadRepositoryInterface;
use App\Repositories\Read\User\UserReadRepository;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Repositories\Write\Import\ImportUserWriteRepository;
use App\Repositories\Write\Import\ImportUserWriteRepositoryInterface;
use App\Repositories\Write\User\UserWriteRepository;
use App\Repositories\Write\User\UserWriteRepositoryInterface;

class RepositoryServiceProvider extends AppServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ImportUserReadRepositoryInterface::class,
            ImportUserReadRepository::class
        );

        $this->app->bind(
            ImportUserWriteRepositoryInterface::class,
            ImportUserWriteRepository::class
        );

        $this->app->bind(
            UserWriteRepositoryInterface::class,
            UserWriteRepository::class
        );

        $this->app->bind(
            UserReadRepositoryInterface::class,
            UserReadRepository::class
        );
    }
}
