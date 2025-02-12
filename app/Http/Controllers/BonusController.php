<?php

namespace App\Http\Controllers;

use App\Http\Requests\BonusStoreRequest;
use App\Http\Resources\BonusResource;
use App\Models\BonusAccount;
use Illuminate\Http\JsonResponse;

class BonusController extends Controller
{
    public function index(BonusAccount $account): JsonResponse
    {
        $bonuses = $account->bonuses();

        return BonusResource::collection($bonuses->paginate())->response();
    }

    public function store(BonusAccount $account, BonusStoreRequest $request): BonusResource
    {
        $bonus = $account->bonuses()->create($request->validated());

        return new BonusResource($bonus);
    }
}
