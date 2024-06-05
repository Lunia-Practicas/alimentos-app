<?php

namespace Tests\Feature;

use App\Http\Controllers\SearchEmailsController;
use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchEmailsTest extends TestCase
{
    use RefreshDatabase;

    private Request $request;

    private SearchEmailsController $searchEmailsController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->searchEmailsController = $this->app->make(SearchEmailsController::class);
    }

    #[Test] public function testSearchEmails()
    {
        $emailA = Email::factory()->create([
            'email' => 'jaime@gmail.com',
            'name_client' => 'Jaime',
        ]);

        $emailB = Email::factory()->create([
            'email' => 'pepe@gmail.com',
            'address' => 'Calle Falsa',
        ]);


        $requestA = new Request([
            'email' => $emailA->email,
        ]);

        $resA = $this->searchEmailsController->__invoke($requestA);

        foreach ($resA as $email) {
            $this->assertEquals($email['email'], $emailA->email);
            $this->assertEquals($email['name_client'], $emailA->name_client);
        }

        $this->assertCount(1, $resA);

        $requestB = new Request([
            'address' => $emailB->address,
        ]);

        $resB = $this->searchEmailsController->__invoke($requestB);

        foreach ($resB as $email) {
            $this->assertEquals($email['email'], $emailB->email);
            $this->assertEquals($email['address'], $emailB->address);
        }

        $this->assertCount(1, $resB);

    }

    #[Test] public function testSearchEmailsEmptyRequest()
    {
        Email::factory()->create([
            'email' => 'jaime@gmail.com'
        ]);

        Email::factory()->create([
            'email' => 'pepe@gmail.com'
        ]);


        $request = new Request([]);

        $resA = $this->searchEmailsController->__invoke($request);

        $this->assertCount(2, $resA);
    }

    #[Test] public function testSearchEmailsNotFoundRequest()
    {
        Email::factory()->create([
            'email' => 'jaime@gmail.com'
        ]);

        Email::factory()->create([
            'email' => 'pepe@gmail.com'
        ]);


        $request = new Request([
            'email' => 'antonio@gmail.com'
        ]);

        $resA = $this->searchEmailsController->__invoke($request);

        $this->assertCount(0, $resA);
    }

}
