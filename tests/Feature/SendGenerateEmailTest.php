<?php

namespace Tests\Feature;

use App\Http\Controllers\SendGenerateEmailController;
use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SendGenerateEmailTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;

    private SendGenerateEmailController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(SendGenerateEmailController::class);
    }

    #[Test] public function testSendGenerateEmail()
    {
        $emailA = Email::factory()->create();
        $emailB = Email::factory()->create();

        Mail::fake();

        $request = new Request([
           'subjectContent' => 'Asunto',
            'htmlContent' => 'contenido del body'
        ]);

        $this->controller->__invoke($request);

        $this->assertDatabaseHas('audits', [
            'addressee' => $emailA->email,
            'subject' => 'Asunto',
            'body' => 'contenido del body'
        ]);
        $this->assertDatabaseHas('audits', [
            'addressee' => $emailB->email,
            'subject' => 'Asunto',
            'body' => 'contenido del body'
        ]);
    }

    #[Test] public function testSendGenerateEmailFail()
    {
        $emailA = Email::factory()->create();

        Mail::fake();
        Mail::shouldReceive('to->send')
            ->once()
            ->andThrow(new \Exception('Mail sending failed'));

        $request = new Request([
            'subjectContent' => 'Asunto',
            'htmlContent' => 'contenido del body'
        ]);

        $this->controller->__invoke($request);

        $this->assertDatabaseHas('audits', [
            'addressee' => $emailA->email,
            'subject' => 'Asunto',
            'body' => 'contenido del body',
            'error' => 'Mail sending failed'
        ]);

    }
}
