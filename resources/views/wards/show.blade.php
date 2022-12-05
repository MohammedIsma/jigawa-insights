@extends('layouts.app')

@section('content')
    <div class="my-devices-area ml-4">
        <div class="container-fluid">
            <div class="content-sright">
                <div class="my-file-area">
                    <div class="quick-access">
                        <p class="h5">WARD: <strong>{{$Ward->name}}</strong> Overview</p>
                        <hr />
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="device-content card-box-style">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device">
                                                <span class="title">LGA</span>
                                                <h4>{{ $Ward->LGA->name }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device border-style-4fcb8d">
                                                <span class="title">Polling Unit Count</span>
                                                <h4>{{ number_format($Ward->PollingUnits->count()) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device border-style-fec107">
                                                <span class="title">Registered Voters</span>
                                                <p class="h4">{{ $Ward->PollingUnits->sum('voter_count') }}</p>
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
                                    @foreach($Ward->Officials() as $Official)
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <div class="single-friend rank{{$Official->ranking}}">
                                                <div class="friend-content p-2">
                                                    <div class="d-flex justify-content-between">
                                                        <h3><a href="#">{{ $Official->name }}</a> <span style="color:#369;font-size:.8em;"><small>{{$Official->phone_number}}</small></span></h3>
                                                    </div>
                                                    <ul class="info mt-0">
                                                        <li class="p-0">
                                                            <i class="ri-mail-line"></i> {{ $Official->OfficialType->name }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="h5">PUs in {{$Ward->name}}</p>
                                <div class="row">
                                    @foreach($Ward->PollingUnits as $PU)
                                        <div class="col-xxl-1 col-md-2 col-sm-4 mb-5">
                                            <div class="single-folder text-center">
                                                <a href="{{ route('pu.show', $PU->id) }}">
                                                    <div class="file">
                                                        <img src="/assets/images/file/file.svg" alt="file" width="50" />
                                                    </div>
                                                    <h6 class="mb-0">{{ $PU->name }}</h6>
                                                </a>
                                                <div>{{ number_format(rand(112,5281)) }} voters</div>
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
