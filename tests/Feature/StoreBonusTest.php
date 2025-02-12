<?php

namespace Tests\Feature;

use App\Http\Controllers\BonusController;
use App\Models\Bonus;
use App\Models\BonusAccount;
use App\Models\User;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Tests\TestCase;

class StoreBonusTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $user->assignRole('admin');
        $this->actingAs($user);
    }

    public function route(array $params = []): string
    {
        return action([BonusController::class, 'store'], $params);
    }

    public function testStoreBonusSucceed(): void
    {
        $bonusAccount = BonusAccount::factory()->create();
        $amount = $this->faker()->randomDigitNotZero();

        $response = $this->postJson($this->route(['account' => $bonusAccount->id]), [
            'amount' => $amount
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas(Bonus::class, ['amount' => $amount, 'bonus_account_id' => $bonusAccount->id]);
    }

    public function testStoreBonusWithBadRequestFail(): void
    {
        $bonusAccount = BonusAccount::factory()->create();

        $response = $this->postJson($this->route(['account' => $bonusAccount->id]), [
            'amount' => $this->faker->word
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['amount']);
    }

    public function testStoreBonusWithoutAmountFail(): void
    {
        $bonusAccount = BonusAccount::factory()->create();

        $response = $this->postJson($this->route(['account' => $bonusAccount->id]));

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['amount']);
    }

    public function testStoreBonusWithoutAdminRoleFail(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $bonusAccount = BonusAccount::factory()->create();

        $this->postJson($this->route(['account' => $bonusAccount->id]))
            ->assertForbidden();
    }
}
