<html>
    <title>Weather Watcher</title>
    <body>
        @if(isset($errors))
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
        {{ Form::model($city, array('action' => array('CityController@update'))) }}
        City: {{ Form::text('name') }}
        {{ Form::token() }}
        {{ Form::submit('Watch') }}
        {{ Form::close() }}
    </body>
</html>