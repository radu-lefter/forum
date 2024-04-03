<?php

// use App\Models\User;
// use Illuminate\Support\Facades\Hash;

// test('password can be updated', function () {
//     $this->actingAs($user = User::factory()->create());

//     $response = $this->put('/user/password', [
//         'current_password' => 'password',
//         'password' => 'new-password',
//         'password_confirmation' => 'new-password',
//     ]);

//     expect(Hash::check('new-password', $user->fresh()->password))->toBeTrue();
// });

// test('current password must be correct', function () {
//     $this->actingAs($user = User::factory()->create());

//     $response = $this->put('/user/password', [
//         'current_password' => 'wrong-password',
//         'password' => 'new-password',
//         'password_confirmation' => 'new-password',
//     ]);

//     $response->assertSessionHasErrors();

//     expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
// });

// test('new passwords must match', function () {
//     $this->actingAs($user = User::factory()->create());

//     $response = $this->put('/user/password', [
//         'current_password' => 'password',
//         'password' => 'new-password',
//         'password_confirmation' => 'wrong-password',
//     ]);

//     $response->assertSessionHasErrors();

//     expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
// });


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testPasswordCanBeUpdated()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    public function testCurrentPasswordMustBeCorrect()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertSessionHasErrors();

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    public function testNewPasswordsMustMatch()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->put('/user/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }
}
