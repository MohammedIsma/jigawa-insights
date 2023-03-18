@extends('layouts.app')

@section('content')
    <div class="my-devices-area ml-4">
        <div class="container-fluid">
            <div class="content-sright">
                <div class="my-file-area">
                    <div class="quick-access">
                        <div class="row text-center">
                            <div class="col-12">
                                <a class="btn btn-light" href="{{ route("lga.show", $Ward->lga_id) }}"><i class="fa fa-arrow-left"></i>
                                    {{ $Ward->LGA->name }} L.G</a>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-12 col-md-6 card">
                                <div class="card-body text-black pt-3 pb-0 px-3">
                                    <p class="h2 text-center">&gt;&gt; {{ $Ward->name }} Ward &lt;&lt;</p>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device">
                                                <span class="title text-black">LGA</span>
                                                <h4>{{ $Ward->LGA->name }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device border-style-fec107">
                                                <span class="title text-black">Registered Voters</span>
                                                <p class="h4">{{ number_format($Ward->PollingUnits->sum('voter_count')) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4">
                                            <div class="single-device border-style-fec107">
                                                <span class="title text-black">Turnout</span>
                                                <p class="h4">{{ $Ward->turnout }}%</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="accreditation_card">
                                    <span class="heading">Accreditation</span>
                                    <span class="label">
                                        {{ $Ward->accreditation_percentage }}%
                                        <span style="font-size:.7em;">reported</span>
                                    </span>
                                    <span class="voters">{{ number_format($Ward->accredited_voters) }} voters</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="accreditation_card">
                                    <span class="heading">Results</span>
                                    <span class="label">0%</span>
                                    <span class="voters">APC => 0</span>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-12">
                                <p class="h5 text-warning">PUs in {{$Ward->name}} ({{ $Ward->PollingUnits->count() }})</p>
                                <form action="{{ route('submit_ward_results', $Ward->id) }}" method="POST" name="frmSubmitResults">
                                    @csrf
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="bg-white p-3">
                                            <polling-unit-result-entry :user_id="{{ auth()->user()->id }}" :ward_id="{{$Ward->id}}"></polling-unit-result-entry>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
