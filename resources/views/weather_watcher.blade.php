<html>
    <title>Weather Watcher</title>
    <body>
        @if (isset($errors))
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
        {{ Form::model($city, array('action' => array('WeatherWatcherController@updateCity'))) }}
        City name: {{ Form::text('name') }}
        {{ Form::token() }}
        {{ Form::submit('Lookup') }}
        {{ Form::close() }}

        @if (isset($weather))
            Temp: {!! $weather->temperature !!}
            <br/>
            Wind speed: {{ $weather->wind->speed }}
            <br/>
            Wind direction: {{ $weather->wind->direction }}
        @endif

        <br/><br/>
        {{ Form::open(array('action' => array('WeatherWatcherController@addTrigger'))) }}
        An email will be sent when the selected city wind speed rises above 10m/s or drops below 10m/s;
        <br/>
        Email: {{ Form::text('email') }}
        {{ Form::token() }}
        {{ Form::submit('Alert Me') }}
        {{ Form::close() }}
    </body>
</html>