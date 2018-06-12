<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Agency;

class AgencyFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_name_filter_returns_correct_results_when_filtering_with_the_exact_name()
    {
        $agencies = factory(Agency::class,10)->create();
        $data = $agencies->toArray();
        $this->assertCount(10,Agency::all());
        $response = $this->get(route('agencies.index',['name' => $data[0]['name']]));
        $content = json_decode($response->content(),true);
        $records = $content['data'];
        $this->assertCount(1,$records);
        $diff = array_diff($data[0],$records[0]);
        $this->assertCount(0,$diff);
    }
}
