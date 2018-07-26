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
        {{ Form::submit('Watch') }}
        {{ Form::close() }}

        @if (isset($weather))
            Temp: {!! $weather->temperature !!}
            <br/>
            Wind speed: {{ $weather->wind->speed }}
            <br/>
            Wind direction: {{ $weather->wind->direction }}
        @endif
    </body>
</html>