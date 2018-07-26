<?php

namespace MariusLab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MariusLab\City;

class CityController extends Controller
{
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->action('WeatherWatcherController@index')->withErrors($validator);
        }

        $city = City::create(['name' => $request->get('name')]);
        $city->save();

        return redirect()->action('WeatherWatcherController@index');
    }
}
