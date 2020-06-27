@extends('master')
@section('content')
<form action="{{route('trip.book')}}" method="post">
    <div class="row">
        <div class="col-md-8 text-left" style="padding-top:7px;">
            @foreach($data['availableSeats'] as $k => $v)
                <span class="badge badge-primary">
                    <input type="radio" name="seat_id" value="{{ $v }}" style="cursor:pointer"> {{ $k }}
                </span>
            @endforeach
        </div>
        <div class="col-md-4 text-right">
            <button type="submit" class="btn btn-outline-primary btn-sm">Book</button>
        </div>
    </div>
    <input type="hidden" name="line_id" value="{{$data['lineId']}}">
    <input type="hidden" name="trip_id" value="{{$data['tripId']}}">
    @csrf
</form>
@endsection
