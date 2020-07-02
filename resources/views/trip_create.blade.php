@extends('master')
@section('content')
<div class="links">
    <form action="{{route('trip.create')}}" method="post">
        <div class="row">
                <div class="col-md-12" id="trip_create_form_inputs">
                    <div class="form-group">
                        <input type="text" name="bus_name" placeholder="Trip Bus Name" class="form-control">
                        @error('bus_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    Start Add trip stations in order
                    <div class="card">
                        <div class="card-body">
                            <ol style="margin-bottom:0"></ol>
                        </div>
                    </div>
                    @error('bus_name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <hr>
                <div class="col-md-2">
                    <div class="form-group">
                        <span type="submit" class="badge badge-success" id="add_station_button">+station</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Create Trip</button>     
                    </div>
                </div>
        </div>
        @csrf
    </form>
</div>
<div style="display:none;" id="trip_station_select">
    <li style="margin-bottom:3px">
        <select name="station[]" class="form-control" required>
            <option value="">Choose Trip Stations</option>
            @foreach($stations as $station)
                <option value="{{$station->id}}">{{$station->name   }}</option>
            @endforeach    
        </select>
    </li>
</div>
@endsection
@section('page-js')
    <script>
        $('#add_station_button').on('click', function(){
            var d = $("#trip_station_select").html();
            $("#trip_create_form_inputs .card-body ol").append(d);
        })
    </script>
@endsection
