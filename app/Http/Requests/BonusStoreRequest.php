<?php

namespace App\Http\Requests;

use App\Models\BonusAccount;
use App\Rules\PositiveTotal;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read BonusAccount $account
 */
class BonusStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'amount' => ['required', 'integer', new PositiveTotal($this->account)],
            'comment' => ['string'],
        ];
    }
}
