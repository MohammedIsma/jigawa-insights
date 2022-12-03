@extends('layouts.app')

@section('content')
    <div class="services-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 pb-3">
                    <p class="h4">Supported States</p>
                </div>
                @foreach($States as $State)
                <div class="col-12 col-md-4">
                    <div class="card mb-4 services-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $State->name }}</h5>
                            <a href="{{ url('/lga/'.$State->id.'/') }}" class="btn btn-md btn-primary">Click to Open</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
