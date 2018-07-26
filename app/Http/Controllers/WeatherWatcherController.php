<?php

namespace MariusLab\Http\Controllers;

use Illuminate\Http\Request;
use MariusLab\City;

class WeatherWatcherController extends Controller
{
    public function index()
    {
        return view('weather_watcher', [
            'city' => City::orderBy('created_at', 'desc')->first()
        ]);
    }
}
