<?php

namespace MariusLab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MariusLab\City;
use MariusLab\Services\OpenWeatherClient;
use MariusLab\Trigger;
use MariusLab\User;

class WeatherWatcherController extends Controller
{
    private $weatherClient;

    public function __construct(OpenWeatherClient $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    public function index()
    {
        $selectedCity = City::orderBy('created_at', 'desc')->first();
        if ($selectedCity !== null) {
            $weather = $this->weatherClient->queryCity($selectedCity->name);
        } else {
            $weather = null;
        }

        return view('weather_watcher', [
            'city' => $selectedCity,
            'weather' => $weather
        ]);
    }

    public function updateCity(Request $request)
    {
        //first validate the city was provided
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->action('WeatherWatcherController@index')->withErrors($validator);
        }

        $weather = $this->weatherClient->queryCity($request->get('name'));

        //now that we know city was provided, we can validate if it exists
        $validator = Validator::make([
            'city' => $weather->city->id,
            ],
            [
            'city' => 'required|not_in:0'
        ]);

        if ($validator->fails()) {
            return redirect()->action('WeatherWatcherController@index')->withErrors($validator);
        }

        $city = City::create(['name' => $request->get('name')]);
        $city->save();

        return redirect()->action('WeatherWatcherController@index');
    }

    public function addTrigger(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->action('WeatherWatcherController@index')->withErrors($validator);
        }

        $user = User::firstOrNew(['email' => $request->get('email')]);
        $user->save();

        $trigger = Trigger::firstOrNew([
            'user_id' => $user->id,
            'weather_attribute' => 'wind.speed',
            'condition' => '>10'
        ]);
        $trigger->save();

        $trigger = Trigger::firstOrNew([
            'user_id' => $user->id,
            'weather_attribute' => 'wind.speed',
            'condition' => '<10'
        ]);
        $trigger->save();

        return redirect()->action('WeatherWatcherController@index');
    }
}
