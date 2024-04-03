<?php

// use App\Models\User;
// use Laravel\Jetstream\Features;

// test('api tokens can be created', function () {
//     if (Features::hasTeamFeatures()) {
//         $this->actingAs($user = User::factory()->withPersonalTeam()->create());
//     } else {
//         $this->actingAs($user = User::factory()->create());
//     }

//     $response = $this->post('/user/api-tokens', [
//         'name' => 'Test Token',
//         'permissions' => [
//             'read',
//             'update',
//         ],
//     ]);

//     expect($user->fresh()->tokens)->toHaveCount(1);
//     expect($user->fresh()->tokens->first())
//         ->name->toEqual('Test Token')
//         ->can('read')->toBeTrue()
//         ->can('delete')->toBeFalse();
// })->skip(function () {
//     return ! Features::hasApiFeatures();
// }, 'API support is not enabled.');

use App\Models\User;
use Laravel\Jetstream\Features;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateApiTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testApiTokensCanBeCreated()
    {
        if (!Features::hasApiFeatures()) {
            $this->markTestSkipped('API support is not enabled.');
        }

        if (Features::hasTeamFeatures()) {
            $this->actingAs($user = User::factory()->withPersonalTeam()->create());
        } else {
            $this->actingAs($user = User::factory()->create());
        }

        $response = $this->post('/user/api-tokens', [
            'name' => 'Test Token',
            'permissions' => [
                'read',
                'update',
            ],
        ]);

        $this->assertCount(1, $user->fresh()->tokens);
        $token = $user->fresh()->tokens->first();
        $this->assertEquals('Test Token', $token->name);
        $this->assertTrue($token->can('read'));
        $this->assertFalse($token->can('delete'));
    }
}
