<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetImportUsersStatusRequest;
use App\Http\Resources\User\ImportResource;
use App\Services\User\Actions\GetImportUsersStatusAction;

class GetStatusImportUserController extends ApiController
{
    public function __invoke(
        GetImportUsersStatusRequest $request,
        GetImportUsersStatusAction $getImportUsersStatusAction,
    ): ImportResource {
        return $getImportUsersStatusAction->run($request->getImportId());
    }
}
