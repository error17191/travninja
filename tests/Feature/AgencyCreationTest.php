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
        //creating new agency
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        //testing the create feature
        $response = $this->post(route('agencies.store'), $data);
        $this->assertCount(1, Agency::all());
        $response->assertJson(['data' => $data]);
        $content = json_decode($response->content());
        $content = (array)$content->data;
        unset($content['id']);
        unset($content['created_at']);
        unset($content['updated_at']);
        $this->assertEquals(count($data),count($content));
        $diff = array_diff($data,$content);
        $this->assertCount(0,$diff);
    }

    public function test_that_agencies_can_be_shown(){
        //creating new agency
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        $this->post(route('agencies.store'), $data);
        //testing the show all agencies feature
        $response = $this->get(route('agencies.show.all'));
        $response->assertJsonCount(1);
        $response->assertStatus(200);
        $content = json_decode($response->content());
        $content = (array)$content->data[0];
        unset($content['id']);
        unset($content['created_at']);
        unset($content['updated_at']);
        $this->assertEquals(count($data),count($content));
        $diff = array_diff($data,$content);
        $this->assertCount(0,$diff);
    }

    public function test_that_agency_can_be_updated(){
        //creating new agency
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        $this->post(route('agencies.store'), $data);
        //testing the update agency feature
        $this->assertNotEquals($data['name'],'Ibrahim Ahmed');
        $data['name'] = 'Ibrahim Ahmed';
        $response = $this->put(route('agency.update',1),$data);
        $response->assertJson(['data' => $data]);
        $content = json_decode($response->content());
        $content = (array)$content->data;
        unset($content['id']);
        unset($content['created_at']);
        unset($content['updated_at']);
        $this->assertEquals(count($data),count($content));
        $diff = array_diff($data,$content);
        $this->assertCount(0,$diff);
        $this->assertEquals($content['name'],'Ibrahim Ahmed');
    }

    public function test_that_agency_can_be_deleted(){
        //creating new agency
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        $this->post(route('agencies.store'), $data);
        //testing delete agency feature
        $response = $this->delete(route('agency.destroy',1));
        $this->assertCount(0, Agency::all());
        $response->assertStatus(200);
        $content = json_decode($response->content());
        $this->assertTrue($content->status);
    }

    public function test_show_one_agency(){
        //creating new agency
        $agency = factory(Agency::class)->make();
        $data = $agency->toArray();
        $this->post(route('agencies.store'), $data);
        //testing show one agency feature
        $response = $this->get(route('agency.show.one',1));
        $response->assertStatus(200);
        $response->assertJson(['data' => $data]);
        $content = json_decode($response->content());
        $content = (array)$content->data;
        unset($content['id']);
        unset($content['created_at']);
        unset($content['updated_at']);
        $this->assertEquals(count($data),count($content));
        $diff = array_diff($data,$content);
        $this->assertCount(0,$diff);
    }
}
