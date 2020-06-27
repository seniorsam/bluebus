@extends('master')
@section('content')
<div class="links">
    <form action="{{route('trip.search')}}" method="post">
        <div class="row">
                <div class="col-md-5">
                <select name="from_id" class="form-control" required>
                    <option value="">Station From</option>
                    @foreach($stations as $station)
                        <option value="{{$station->id}}">{{$station->name   }}</option>
                    @endforeach    
                </select>
                </div>
                <div class="col-md-5">                            
                <select name="to_id" class="form-control" required>
                    <option value="">Station To</option>
                    @foreach($stations as $station)
                        <option value="{{$station->id}}">{{$station->name   }}</option>
                    @endforeach  
                </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary form-control">Search</button>     
                </div>
        </div>
        @csrf
    </form>
</div>
@endsection
