<?php

namespace App\Rules;

use App\Models\BonusAccount;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class PositiveTotal implements ValidationRule
{
    public function __construct(protected ?BonusAccount $account = null)
    {
    }
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value >= 0) {
            return;
        }

        if ($this->account->total < abs($value)) {
            $fail("На бонусном счете недостаточно средств для выполнения операции");
        };
    }
}
