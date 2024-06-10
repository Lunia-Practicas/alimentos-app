<?php

namespace Tests\Feature;

use App\Http\Controllers\UpdateEmailTemplateController;
use App\Models\EmailTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateEmailTemplateTest extends TestCase
{
    use RefreshDatabase;

    private Request $request;
    private UpdateEmailTemplateController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(UpdateEmailTemplateController::class);
    }

    #[Test] public function testUpdateEmailTemplate()
    {
        $emailTemplate = EmailTemplate::factory()->create([
            'title' => 'Test title',
            'subject' => 'Test subject',
            'body' => 'Test body',
        ]);

        $request = new Request([
           'title' => $emailTemplate->title,
           'subject' => 'Nuevo asunto',
            'body' => 'Nuevo contenido',
        ], [],[],[],[],[
            'REQUEST_URI' => 'api/email-templates/update/' . $emailTemplate->id,
        ]);

        $request->setRouteResolver(function () use ($request, $emailTemplate) {
            return (new Route(
                'PATCH',
                'api/email-templates/update/{id}',
                []
            ))->bind($request);
        });

        $this->controller->__invoke($request);

        $this->assertDatabaseHas('email_templates', [
            'title' => 'Test title',
            'subject' => 'Nuevo asunto',
            'body' => 'Nuevo contenido',
        ]);

        $this->assertDatabaseMissing('email_templates', [
            'subject' => 'Test subject',
            'body' => 'Test body',
        ]);

    }

}
