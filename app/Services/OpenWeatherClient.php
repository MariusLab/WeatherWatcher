<?php

namespace MariusLab\Services;

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\CurrentWeather;

class OpenWeatherClient
{
    /** @var string */
    private $lang;
    /** @var string */
    private $units;
    /** @var OpenWeatherMap */
    private $owm;

    public function __construct()
    {
        $this->lang = env('APP_LANG');
        $this->units = env('APP_UNITS');

        $this->owm = new OpenWeatherMap(env('OPEN_WEATHER_MAP_API_KEY'));
    }

    public function queryCity(string $city): CurrentWeather
    {
        try {
            $weather = $this->owm->getWeather($city, $this->units, $this->lang);
        } catch(OWMException $e) {
            echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
        } catch(\Exception $e) {
            echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
        }

        return $weather;
    }

    public function addTrigger(OpenWeatherMap\Util\City $city, array $triggers)
    {
      //make a POST HTTP request to openweathermap triggers endpoint
    }
}
