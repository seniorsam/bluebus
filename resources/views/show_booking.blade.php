@extends('master')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('trip.book')}}" method="post">
            <div class="row">
                <div class="col-md-8 text-left" style="padding-top:7px;">
                    @forelse($data['availableSeats'] as $k => $v)
                        <span class="badge badge-primary">
                            <input type="radio" name="seat_id" value="{{ $v }}" style="cursor:pointer"> {{ $k }}
                        </span>
                    @empty
                        No Seats Available        
                    @endforelse
                </div>
                <div class="col-md-4 text-right">
                    @if(!empty($data['availableSeats']))
                        <button type="submit" class="btn btn-outline-primary btn-sm">Book</button>
                    @endif
                </div>
            </div>
            <input type="hidden" name="line_id" value="{{$data['lineId']}}">
            <input type="hidden" name="trip_id" value="{{$data['tripId']}}">
            @csrf
        </form>
    </div>
</div>
@endsection
