<?php

namespace Database\Factories;

use App\Models\BonusAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends Factory<BonusFactory>
 */
class BonusFactory extends Factory
{
    public function definition(): array
    {
        return [
            'bonus_account_id' => BonusAccount::factory(),
            'amount' => $this->faker->boolean() ? $this->faker->randomDigitNotZero() : -$this->faker->randomDigitNotZero(),
            'comment' => $this->faker->sentence(),
        ];
    }
}
