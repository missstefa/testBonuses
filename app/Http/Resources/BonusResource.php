<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BonusResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'bonus_account_id' => $this->bonus_account_id,
            'amount' => $this->amount,
            'comment' => $this->comment
        ];
    }

}
