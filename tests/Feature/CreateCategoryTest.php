<?php

namespace Tests\Feature;

use App\Http\Controllers\CreateCategoryController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;

    private CreateCategoryController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new Request([
            'name' => 'test',
        ]);
        $this->controller = $this->app->make(CreateCategoryController::class);
    }

    #[Test] public function test_create_category_db()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->controller->__invoke($this->request);

        $this->assertDatabaseHas('categories', [
            'name' => 'test',
        ]);
    }

    #[Test] public function test_can_not_create_same_name_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->controller->__invoke($this->request);

        $exceptionThrown = false;
        try {
            $this->controller->__invoke($this->request);
        } catch (\Exception $exception) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);

    }
}
