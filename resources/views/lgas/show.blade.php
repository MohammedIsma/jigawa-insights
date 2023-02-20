@extends('layouts.app')

@section('content')
    <div class="my-devices-area ml-4">
        <div class="container-fluid">
            <div class="content-sright">
                <div class="my-file-area">
                    <div class="quick-access">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="device-content card-box-style pt-3 pb-0 px-3">
                                    <p class="h5 text-center">&gt;&gt; {{ $LGA->name }} &lt;&lt;</p>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device">
                                                <span class="title text-black">Ward Count</span>
                                                <h4>{{ number_format($LGA->Wards->count()) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device border-style-4fcb8d">
                                                <span class="title  text-black">Polling Unit Count</span>
                                                <h4>{{ number_format($LGA->PollingUnits->count()) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device border-style-fec107">
                                                <span class="title text-black">Registered Voters</span>
                                                <p class="h4">{{ number_format($LGA->PollingUnits->sum('voter_count')) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="accreditation_card">
                                    <span class="heading">Accreditation</span>
                                    <span class="label">0%</span>
                                    <span class="voters">0 voters</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="accreditation_card">
                                    <span class="heading">Results</span>
                                    <span class="label">0%</span>
                                    <span class="voters">APC => 0 votes</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="accreditation_card text-center pt-2 pb-3 bg-success">
                                    <span class="heading text-center">Incidents</span>
                                    <span class="label"><i class="fa fa-thumbs-up"></i> 0</span>
                                </div>
                            </div>
                        </div>
                        <hr class="m-0"     />
                        <div class="row">
                            <div class="col-12">
                                <p class="h5 text-warning">Wards in {{$LGA->name}}</p>
                                <div class="row">
                                    @foreach($LGA->Wards as $Ward)
                                        <div class="col-xxl-1 col-md-2 col-sm-4 mb-5">
                                            <div class="single-folder text-center">
                                                <a href="{{ route('ward.show', $Ward->id) }}">
                                                    <div class="file">
                                                        <img src="/assets/images/file/file.svg" alt="file" width="50" />
                                                    </div>
                                                    <h6 class="text-white mb-0">{{ $Ward->name }}</h6>
                                                </a>
                                                <span>{{ $Ward->PollingUnits->count() }} PUs</span>
                                                <div>{{ number_format(\App\Models\PollingUnit::where('ward_id', $Ward->id)->sum('voter_count')) }} voters</div>
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
