<?php

// use App\Models\User;

// test('profile information can be updated', function () {
//     $this->actingAs($user = User::factory()->create());

//     $response = $this->put('/user/profile-information', [
//         'name' => 'Test Name',
//         'email' => 'test@example.com',
//     ]);

//     expect($user->fresh())
//         ->name->toEqual('Test Name')
//         ->email->toEqual('test@example.com');
// });

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function testProfileInformationCanBeUpdated()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/profile-information', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
        ]);

        $user = $user->fresh();

        $this->assertEquals('Test Name', $user->name);
        $this->assertEquals('test@example.com', $user->email);
    }
}
