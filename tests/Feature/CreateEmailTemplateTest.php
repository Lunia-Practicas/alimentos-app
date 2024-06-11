<?php

namespace Tests\Feature;

use App\Http\Controllers\CreateEmailTemplateController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateEmailTemplateTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;

    private CreateEmailTemplateController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(CreateEmailTemplateController::class);
    }

    #[Test] public function testCreateEmailTemplate()
    {
        $this->request = new Request([
            'title' => 'Plantilla 1',
            'subject' => 'Asunto 1',
            'body' => 'Cuerpo de la plantilla 1',
        ]);

        $emailTemplate = $this->controller->__invoke($this->request);

        $this->assertDatabaseHas('email_templates', [
            'title' => 'Plantilla 1',
        ]);

    }

    #[Test] public function testCanNotCreateEmailTemplateSameTitle()
    {
        $this->request = new Request([
            'title' => 'Plantilla 1',
            'subject' => 'Asunto 1',
            'body' => 'Cuerpo de la plantilla 1',
        ]);

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
