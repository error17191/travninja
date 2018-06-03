<?php

namespace Tests\Feature;

use Illuminate\Validation\ValidationException;
use function Psy\debug;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Agency;

class AgencyCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_agency_can_be_created()
    {
        //creating new agency
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        //testing the create feature
        $response = $this->post(route('agencies.store'), $data);
        $this->assertCount(1, Agency::all());
        $response->assertJson(['data' => $data]);
        $content = json_decode($response->content(), true)['data'];

        unset($content["id"]);
        unset($content['created_at']);
        unset($content['updated_at']);

        $this->assertEquals(count($data), count($content));
        $diff = array_diff($data, $content);
        $this->assertCount(0, $diff);
    }

    public function test_that_agencies_can_be_shown()
    {
        //creating new agency
        $agency = factory(Agency::class)->create();
        $data = $agency->toArray();
        //testing the show all agencies feature
        $response = $this->get(route('agencies.index'));
        $response->assertJsonCount(1);
        $response->assertStatus(200);
        $content = json_decode($response->content(), true)['data'];
        $this->assertEquals(1, $this->count($content));

        $this->assertEquals(count($data), count($content[0]));
        $diff = array_diff($data, $content[0]);
        $this->assertCount(0, $diff);
    }

    public function test_that_agency_can_be_updated()
    {
        //creating new agency
        $agency = factory(Agency::class)->create();
        $data = $agency->toArray();
        //testing the update agency feature

        $data['name'] .= '-new';

        $response = $this->put(route('agencies.update', $agency), $data);
        $response->assertJson(['data' => $data]);

        $content = json_decode($response->content(), true)['data'];

        $this->assertEquals(count($data), count($content));
        $diff = array_diff($data, $content);
        $this->assertCount(0, $diff);
        $this->assertEquals($content['name'], $data['name']);
    }

    public function test_that_agency_can_be_deleted()
    {
        //creating new agency
        $agency = factory(Agency::class)->create();

        //testing delete agency feature
        $response = $this->delete(route('agencies.destroy', $agency));
        $this->assertCount(0, Agency::all());
        $response->assertStatus(200);
        $content = json_decode($response->content(), true);
        $this->assertTrue($content['status']);
    }

    public function test_show_one_agency()
    {
        //creating new agency
        $agency = factory(Agency::class)->create();

        //testing show one agency feature
        $response = $this->get(route('agencies.show', 1));
        $response->assertStatus(200);
        $data = $agency->toArray();

        $response->assertJson(['data' => $data]);
        $content = json_decode($response->content(), true)['data'];

        $this->assertEquals(count($data), count($content));
        $diff = array_diff($data, $content);
        $this->assertCount(0, $diff);
    }

    public function test_required_validation_on_create_agency_name_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        //test the required on name field
        $data['name'] = '';
        $this->post(route('agencies.store'), $data);
    }

    public function test_required_validation_on_create_agency_uid_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        //test the required on uid field
        $data['uid'] = '';
        $this->post(route('agencies.store'), $data);
    }

    public function test_required_validation_on_create_agency_phone_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        //test the required on phone field
        $data['phone'] = '';
        $this->post(route('agencies.store'), $data);
    }

    public function test_required_validation_on_create_agency_mobile_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        //test the required on mobil field
        $data['mobile'] = '';
        $this->post(route('agencies.store'), $data);
    }

    public function test_required_validation_on_update_agency_name_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->create();
        $data = $agency->toArray();
        //test the required on name field
        $data['name'] = '';
        $this->put(route('agencies.update', $agency), $data);
    }

    public function test_required_validation_on_update_agency_uid_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->create();

        //test the required on uid field
        $data['uid'] = '';
        $this->put(route('agencies.update', 1), $data);
    }

    public function test_required_validation_on_update_agency_phone_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->create();
        $data = $agency->toArray();
        //test the required on phone field
        $data['phone'] = '';
        $this->put(route('agencies.update', $agency), $data);
    }

    public function test_required_validation_on_update_agency_mobile_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->create();
        //test the required on mobil field
        $data['mobile'] = '';
        $this->put(route('agencies.update', $agency), $data);
    }

    public function test_the_unique_validation_on_creating_agency_at_uid_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->create();

        //testing the unique validation
        $this->post(route('agencies.store'), $agency->toArray());
    }

    public function test_the_unique_validation_on_updating_agency_uid_field()
    {
        //creating new agency
        $this->expectException(ValidationException::class);
        $agency = factory(Agency::class)->create();

        $anotherAgency = factory(Agency::class)->create();

        //test the unique validation
        $this->put(route('agencies.update', $agency), $anotherAgency->toArray());
    }
}
