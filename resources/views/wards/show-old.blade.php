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
                            <div class="col-3">
                                <p class="h5 text-warning">Key People</p>
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
                            <div class="col-9">
                                <p class="h5 text-warning">PUs in {{$Ward->name}} ({{ $Ward->PollingUnits->count() }})</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bg-white">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>DELIM.</th>
                                                    <th>PU</th>
                                                    <th>Reg. Voters</th>
                                                    <th class="text-center">Accreditation</th>
                                                    <th class="text-center">Turnout</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($Ward->PollingUnits as $PU)
                                                    <tr>
                                                        <td>
                                                            @if($PU->has_issue)
                                                                <div class="bg-warning pl-1"><i class="fa fa-exclamation-triangle"></i> Has Issue!</div>
                                                            @else
                                                                @if($PU->accredited_count_1)
                                                                    <span class="text-success">
                                                                        <i class="fa fa-check"></i> Accredited
                                                                    </span>
                                                                @else
                                                                    @if(canUpdatePollingUnit($PU))
                                                                       <a href="{{ route('submit_accreditation', $PU->id) }}" class="btn btn-sm btn-success px-4 py-1">Submit Accreditation</a>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>{{ $PU->number }}</td>
                                                        <td>{{ $PU->name }}</td>
                                                        <td>{{ $PU->voter_count }}</td>
                                                        <td class="text-center">
                                                            {{ $PU->accredited_count_1 ?? 0}}
                                                            <span class="text-{{getAccClass($PU->accreditation_percentage)}}"><small>({{ $PU->accreditation_percentage }})%</small></span>
                                                        </td>
                                                        <td class="text-center bg-{{ getTurnClass($PU->turnout) }}">{{ $PU->turnout }}%</td>
                                                        <td>
                                                            @if(auth()->user()->id==1)
                                                            <a href="{{ route('delete_results', $PU->id)}}" class="text-danger">Del</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
