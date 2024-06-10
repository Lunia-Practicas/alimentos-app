<?php

namespace Tests\Feature;

use App\Http\Controllers\GetEmailTemplateController;
use App\Models\EmailTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetEmailTemplateTest extends TestCase
{
    use RefreshDatabase;

    private Request $request;

    private GetEmailTemplateController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GetEmailTemplateController::class);
    }

    #[Test] public function testGetEmailTemplate()
    {
        $emailTemplateA = EmailTemplate::factory()->create();
        $emailTemplateB = EmailTemplate::factory()->create();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/email-templates/' . $emailTemplateA->id,
        ]);

        $request->setRouteResolver(function () use ($request, $emailTemplateA) {
            return (new Route(
                'GET',
                'api/email-templates/{id}',
                []
            ))->bind($request);
        });

        $emailTemplate = $this->controller->__invoke($request);

        $this->assertEquals($emailTemplate->id, $emailTemplateA->id);
        $this->assertNotEquals($emailTemplate->id, $emailTemplateB->id);
    }

}
