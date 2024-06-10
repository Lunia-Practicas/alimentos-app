<?php

namespace Tests\Feature;

use App\Http\Controllers\DeleteEmailTemplateController;
use App\Models\EmailTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteEmailTemplateTest extends TestCase
{

    use RefreshDatabase;

    private DeleteEmailTemplateController $controller;

    public function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(DeleteEmailTemplateController::class);
    }

    #[Test] public function testDeleteEmailTemplate()
    {
        $emailTemplateA = EmailTemplate::factory()->create();
        EmailTemplate::factory()->create();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/email-templates/' . $emailTemplateA->id,
        ]);

        $request->setRouteResolver(function () use ($request, $emailTemplateA) {
            return (new Route(
                'DELETE',
                'api/email-templates/{id}',
                []
            ))->bind($request);
        });

        $this->assertDatabaseCount('email_templates', 2);

        $this->controller->__invoke($request);

        $this->assertDatabaseCount('email_templates', 1);
        $this->assertDatabaseMissing('email_templates', ['id' => $emailTemplateA->id]);

    }
}
