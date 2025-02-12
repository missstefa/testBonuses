<?php

namespace Tests\Feature;

use App\Http\Controllers\BonusController;
use App\Models\Bonus;
use App\Models\BonusAccount;
use App\Models\User;
use Tests\TestCase;

class IndexBonusTest extends TestCase
{
     public function route(array $params = []): string
    {
        return action([BonusController::class, 'index'], $params);
    }

    public function testIndexBonusSucceed(): void
    {
        $bonusAccount = BonusAccount::factory()->create();
        $bonus = Bonus::factory()->create(['bonus_account_id' => $bonusAccount->id]);

        $response = $this->getJson($this->route(['account' => $bonusAccount->id]));

        $response->assertOk()
        ->assertJsonFragment([
            $bonus->only(['bonus_account_id', 'amount', 'comment'])
        ]);
        $this->assertCount(1, $response->json('data'));
    }

    public function testIndexBonusFailed(): void
    {
        $response = $this->getJson($this->route(['account' =>$this->faker->randomDigitNotZero()]), [
            'amount' => $this->faker->word
        ]);

        $response->assertNotFound();
    }
}
