<?php

// use App\Models\User;
// use Laravel\Jetstream\Features;

// test('user accounts can be deleted', function () {
//     $this->actingAs($user = User::factory()->create());

//     $response = $this->delete('/user', [
//         'password' => 'password',
//     ]);

//     expect($user->fresh())->toBeNull();
// })->skip(function () {
//     return ! Features::hasAccountDeletionFeatures();
// }, 'Account deletion is not enabled.');

// test('correct password must be provided before account can be deleted', function () {
//     $this->actingAs($user = User::factory()->create());

//     $response = $this->delete('/user', [
//         'password' => 'wrong-password',
//     ]);

//     expect($user->fresh())->not->toBeNull();
// })->skip(function () {
//     return ! Features::hasAccountDeletionFeatures();
// }, 'Account deletion is not enabled.');

use App\Models\User;
use Laravel\Jetstream\Features;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    public function testUserAccountsCanBeDeleted()
    {
        if (!Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($user->fresh());
    }

    public function testCorrectPasswordMustBeProvidedBeforeAccountCanBeDeleted()
    {
        if (!Features::hasAccountDeletionFeatures()) {
            $this->markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user', [
            'password' => 'wrong-password',
        ]);

        $this->assertNotNull($user->fresh());
    }
}
