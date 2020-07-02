@extends('master')
@section('content')
<div class="links">
        <!-- <a href="https://laravel.com/docs">Docs</a>
        <a href="https://laracasts.com">Laracasts</a> -->
    </div>

    <br>
        <h2> Available Trips</h2>
        @forelse($lines as $line)
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li><b>From</b>:  {{$line->station_from->name}} </li>
                        <li><b>To</b>:  {{$line->station_to->name}} </li>
                        <li><b>Bus</b>:  {{$line->trip->bus_name}}</li>
                    </ul>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('trip.book.data')}}" method="post">
                                    <input type="hidden" name="line_id" value="{{$line->id}}">
                                    <input type="hidden" name="trip_id" value="{{$line->trip->id}}">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Check Available Seats</button>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div> <br>
        @empty
            This Trip Not Available    
        @endforelse
</div>
@endsection
