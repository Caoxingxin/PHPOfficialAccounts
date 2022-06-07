<?php

namespace Tests\Feature;

use App\Factory\TempFactory;
use App\Helps\Functions;
use App\Http\Model\WeChatUser;
use App\Jobs\TestJob;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testweather(){
        $weatherData = [
            //高德地图控制台的key
            'key' => 'd5c63b169d3ffbedfc579d27dde9107e',
            'city' => '440106',
            'extensions' => 'all',
            'output' => 'JSON'
        ];
        //$result = json_decode((new Functions())->curlGet('https://restapi.amap.com/v3/weather/weatherInfo',$weatherData),true);
        //dd($result);
        $date = Carbon::now();
        //dd((new TempFactory())->setTemp('yxl'));
        TestJob::dispatch();
        dd(123);
    }
}
