<?php

// use App\Models\User;

// test('other browser sessions can be logged out', function () {
//     $this->actingAs($user = User::factory()->create());

//     $response = $this->delete('/user/other-browser-sessions', [
//         'password' => 'password',
//     ]);

//     $response->assertSessionHasNoErrors();
// });

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase;

    public function testOtherBrowserSessionsCanBeLoggedOut()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user/other-browser-sessions', [
            'password' => 'password',
        ]);

        $response->assertSessionHasNoErrors();
    }
}
