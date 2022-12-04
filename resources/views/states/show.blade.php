@extends('layouts.app')

@section('content')
    <div class="my-devices-area ml-4 mt-20">
        <div class="container-fluid">
            <div class="content-sright">
                <div class="my-file-area">
                    <div class="quick-access">
                        <p class="h5">{{$State->name}} State LGAs</p>
                        <hr />
                        <div class="row">
                            @foreach($State->lga as $lga)
                                <div class="col-xxl-1 col-md-2 col-sm-4 mb-5">
                                    <div class="single-folder text-center">
                                        <a href="{{ route('lga.show', $lga->id) }}">
                                            <div class="file">
                                                <img src="/assets/images/file/file.svg" alt="file" width="50" />
                                            </div>
                                            <h6 class="mb-0">{{ $lga->name }}</h6>
                                        </a>
                                        <span>{{ $lga->Wards->count() }} Wards</span>
                                        <div>{{ $lga->Wards->count() * rand(112,528) }} voters</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
