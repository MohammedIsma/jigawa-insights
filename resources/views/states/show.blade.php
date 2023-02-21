@extends('layouts.app')

@section('content')

    <div class="my-devices-area ml-4 mt-20">
        <div class="container-fluid">
            <div class="content-sright">
                <div class="my-file-area">
                    <div class="quick-access">
                        <div class="row">
                            @foreach($State->lga as $lga)
                                <div class="col-xxl-1 col-md-2 col-sm-4 my-1 mx-0 py-4" style="border:1px solid #f00;">
                                    <div class="single-folder text-center">
                                        <a href="{{ route('lga.show', $lga->id) }}">
                                            <div class="file">
                                                <img src="/assets/images/file/file.svg" alt="file" width="50" />
                                            </div>
                                            <h5 class="mb-0 text-white">{{ $lga->name }}</h5>
                                        </a>
                                        <span>{{ $lga->Wards->count() }} Wards</span>
                                        <div>
                                            <span class="mx-2"><i class="fa fa-box"></i> {{ $lga->PollingUnits->count() }} PUs</span>
                                            <span class="mx-2"><i class="fa fa-user"></i> {{ number_format(\App\Models\PollingUnit::where('lga_id', $lga->id)->sum('voter_count')) }}</span>
                                        </div>
                                        <div>
                                            {{ round($lga->accreditation_percentage,1) }}%
                                            <span style="font-size:.7em;">reported</span>
                                            <span class="mx-2 text-success"><i class="fa fa-user"></i> {{ number_format($lga->accredited_voters) }}</span>
                                        </div>
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
