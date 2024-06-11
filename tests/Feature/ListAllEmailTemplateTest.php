<?php

namespace Tests\Feature;

use App\Http\Controllers\ListAllEmailTemplateController;
use App\Models\EmailTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListAllEmailTemplateTest extends TestCase
{
   use RefreshDatabase;

   private Request $request;

   private ListAllEmailTemplateController $controller;

   protected function setUp(): void
   {
       parent::setUp();
       $this->controller = $this->app->make(ListAllEmailTemplateController::class);
   }

   #[Test] public function testListAllEmailTemplate()
   {
       EmailTemplate::factory()->create();
       EmailTemplate::factory()->create();
       EmailTemplate::factory()->create();

       $listEmailTemplates = $this->controller->__invoke();

       $this->assertCount(3, $listEmailTemplates);
   }
}
