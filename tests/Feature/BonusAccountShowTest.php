<?php

namespace Tests\Feature;

use App\Http\Controllers\BonusAccountController;
use App\Models\Bonus;
use App\Models\BonusAccount;
use Tests\TestCase;

class BonusAccountShowTest extends TestCase
{
    public function route(array $params = []): string
    {
        return action([BonusAccountController::class, 'show'], $params);
    }

    public function testShowBonusAccountSucceed(): void
    {
        $bonusAccount = BonusAccount::factory()->create();
        $bonuses = Bonus::factory(['bonus_account_id' => $bonusAccount])->count(10)->create();
        $response = $this->getJson($this->route(['account' => $bonusAccount->id]));

        $expectedTotal = $bonuses->pluck('amount')->sum() / 100;
        $response->assertOk()
            ->assertJsonStructure([
            'data' => [
                'user_id',
                'external_id',
                'total'
            ]
        ])
        ->assertJsonFragment([
            'total' => $expectedTotal
        ]);
    }

}
