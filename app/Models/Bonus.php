<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_account_id',
        'amount',
        'comment'
    ];

    public function bonusAccount(): BelongsTo
    {
        return $this->belongsTo(BonusAccount::class);
    }
}
