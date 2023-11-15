<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportUsersRequest;
use App\Services\User\Actions\ImportUsersActions;
use Illuminate\Http\JsonResponse;
use Throwable;

class ImportUserController extends ApiController
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        ImportUsersRequest $request,
        ImportUsersActions $importUsersActions,
    ): JsonResponse {
        $importId = $importUsersActions->run();

        return $this->response(['importId' => $importId]);
    }
}
