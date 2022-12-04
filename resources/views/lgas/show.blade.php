@extends('layouts.app')

@section('content')
    <div class="my-devices-area ml-4">
        <div class="container-fluid">
            <div class="content-sright">
                <div class="my-file-area">
                    <div class="quick-access">
                        <p class="h5">Local Government Area: <strong>{{$LGA->name}}</strong> Overview</p>
                        <hr />
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="device-content card-box-style">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device">
                                                <span class="title">Ward Count</span>
                                                <h4>{{ number_format($LGA->Wards->count()) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device border-style-4fcb8d">
                                                <span class="title">Polling Unit Count</span>
                                                <h4>{{ number_format($LGA->PollingUnits->count()) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device border-style-fec107">
                                                <span class="title">Registered Voters</span>
                                                <p class="h4">0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-1 offset-md-4">
                                <div class="confidence_card rank0">
                                    0<span>unranked</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="h5">Key People (3)</p>
                                <div class="row justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="single-friend rank2">
                                            <div class="friend-content p-2">
                                                <div class="d-flex justify-content-between">
                                                    <h3><a href="#">Mohammed T Isma</a></h3>
                                                </div>
                                                <ul class="info mt-0">
                                                    <li class="p-0">
                                                        <i class="ri-mail-line"></i> INEC Official
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="single-friend rank4">
                                            <div class="friend-content p-2">
                                                <div class="d-flex justify-content-between">
                                                    <h3><a href="#">Mohammed T Isma</a></h3>
                                                </div>
                                                <ul class="info mt-0">
                                                    <li class="p-0">
                                                        <i class="ri-mail-line"></i> INEC Official
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="h5">Wards in {{$LGA->name}}</p>
                                <div class="row">
                                    @foreach($LGA->Wards as $Ward)
                                        <div class="col-xxl-1 col-md-2 col-sm-4 mb-5">
                                            <div class="single-folder text-center">
                                                <a href="{{ route('ward.show', $Ward->id) }}">
                                                    <div class="file">
                                                        <img src="/assets/images/file/file.svg" alt="file" width="50" />
                                                    </div>
                                                    <h6 class="mb-0">{{ $Ward->name }}</h6>
                                                </a>
                                                <span>{{ $Ward->PollingUnits->count() }} PUs</span>
                                                <div>{{ $Ward->PollingUnits->count() * rand(112,528) }} voters</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
