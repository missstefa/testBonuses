<?php

namespace App\Http\Controllers;

use App\Http\Requests\BonusStoreRequest;
use App\Http\Resources\BonusAccountResource;
use App\Http\Resources\BonusResource;
use App\Models\BonusAccount;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class BonusAccountController extends Controller
{
    public function show(BonusAccount $account): BonusAccountResource
    {
        return new BonusAccountResource($account);
    }

}
