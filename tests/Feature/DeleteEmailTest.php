<?php

namespace Tests\Feature;

use App\Http\Controllers\DeleteEmailController;
use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteEmailTest extends TestCase
{
    use RefreshDatabase;

    private DeleteEmailController $deleteEmailController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->deleteEmailController = $this->app->make(DeleteEmailController::class);
    }

    #[Test] public function testDeleteEmail()
    {
        $emailA = Email::factory()->create();
        Email::factory()->create();
        Email::factory()->create();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/emails/' . $emailA->id,
        ]);

        $request->setRouteResolver(function () use ($request, $emailA) {
            return (new Route(
                'DELETE',
                'api/emails/{id}',
                []
            ))->bind($request);
        });

        $this->assertDatabaseCount('emails', 3);

        $this->deleteEmailController->__invoke($request);

        $this->assertDatabaseCount('emails', 2);

        $this->assertDatabaseMissing('emails', [
            'id' => $emailA->id,
        ]);
    }

    #[Test] public function testDeleteEmailNotFound()
    {
        Email::factory()->create();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/emails/' . 2,
        ]);

        $request->setRouteResolver(function () use ($request) {
            return (new Route(
                'DELETE',
                'api/emails/{id}',
                []
            ))->bind($request);
        });

        $exceptionThrown = false;
        try {
            $this->deleteEmailController->__invoke($request);
        } catch (\Exception $e) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
        $this->assertDatabaseCount('emails', 1);
    }
}
