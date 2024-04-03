<?php

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Tests\TestCase;

// class IndexTest extends TestCase
// {
//     use RefreshDatabase;

//     public function testPostsIndexRouteReturnsCorrectComponent()
//     {
//         $response = $this->get(route('posts.index'));

//         $response->assertInertia(fn ($page) => $page->component('Posts/Index'));
//     }

//     public function testPostsArePassedToView()
//     {

//         $response = $this->get(route('posts.index'));

//         $response->assertInertia(fn ($page) => $page->component('Posts/Index'));
//     }


// }

use Tests\TestCase;
use Inertia\Testing\Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldReturnTheCorrectComponent()
    {
        $response = $this->get(route('posts.index'));

        $response->assertInertia(fn ($page) => $page
            ->component('Posts/Index', true)
        );
    }

    public function testPassesPostsToTheView()
    {
        $response = $this->get(route('posts.index'));

        $response->assertInertia(fn ($page) => $page
            ->has('posts')
        );
    }
}


