<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Agency;

class AgencyCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_agency_can_be_created()
    {
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        $data['password'] = $agency->password;
        $data['password_confirmation'] = $agency->password;
        $response = $this->post('/api/agencies', $data);
        $this->assertCount(1, Agency::all());
        unset($data['password_confirmation']);
        unset($data['password']);
        $response->assertJson(['data' => $data]);
    }

    public function test_that_agency_creation_response_dont_contain_password()
    {

    }
}
