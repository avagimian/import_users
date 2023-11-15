<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetLastImportDetailsRequest;
use App\Http\Resources\User\ImportResource;
use App\Services\User\Actions\GetLastImportDetailsAction;
use Illuminate\Http\JsonResponse;

class GetLastImportUserController extends ApiController
{
    public function __invoke(
        GetLastImportDetailsRequest $request,
        GetLastImportDetailsAction $getLastImportDetailsAction,
    ): ImportResource|JsonResponse {
        $data = $getLastImportDetailsAction->run();

        if (is_null($data)) {
            return $this->response();
        }

        return new ImportResource($data);
    }
}
