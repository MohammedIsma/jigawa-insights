@php use App\Models\PoliticalParty; @endphp
@extends('layouts.app')

@section('content')
    <div class="my-devices-area ml-4">
        <div class="container-fluid">
            <div class="content-sright">
                <div class="my-file-area">
                    <div class="quick-access">
                        <div class="row">
                            <div class="col-3">
                                <p class="h5 text-warning">SUBMIT ACCREDITATION</p>
                                <table class="table text-white">
                                    <tr>
                                        <th>POLLING UNIT</th>
                                        <td>{{ $PU->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>WARD</th>
                                        <td>{{ $PU->Ward->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>LGA</th>
                                        <td>{{ $PU->LGA->name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-9">
                                <p class="h3 text-white">You are <strong>{{ auth()->user()->name }}</strong></p>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="bg-white p-3" style="border-radius: 8px;">
                                            <div class="alert alert-success">
                                                Enter voting results on the right
                                            </div>
{{--                                            <div class="text-center text-primary h3">ACCREDITATION</div>--}}
{{--                                            <form action="{{ route('submit_accreditation', $PU->id) }}" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                <table class="text-black">--}}
{{--                                                    <tr>--}}
{{--                                                        <th>Polling Unit</th>--}}
{{--                                                        <td style="width:50px;"></td>--}}
{{--                                                        <td><p class="h4">{{ $PU->name }}</p></td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <th>Registered Voters</th>--}}
{{--                                                        <td style="width:50px;"></td>--}}
{{--                                                        <td><p class="h6">{{ $PU->voter_count }}</p></td>--}}
{{--                                                    </tr>--}}
{{--                                                    <tr>--}}
{{--                                                        <th>Accredited Voters</th>--}}
{{--                                                        <td style="width:50px;"></td>--}}
{{--                                                        <td>--}}
{{--                                                            @if(!$PU->accredited_voters)--}}
{{--                                                                @if(!config("insights.accreditation_entry_enabled"))--}}
{{--                                                                    <div class="alert alert-warning">--}}
{{--                                                                        Accreditation NOT ready. Please wait...--}}
{{--                                                                    </div>--}}
{{--                                                                @else--}}
{{--                                                                    @if(canUpdatePollingUnit($PU))--}}
{{--                                                                        <div class="alert alert-info">--}}
{{--                                                                            <p class="h6 text-primary">Confirm--}}
{{--                                                                                accreditation</p>--}}
{{--                                                                            <div>--}}
{{--                                                                                <input type="number" class="form-control"--}}
{{--                                                                                       name="box_count" min=1 max=""--}}
{{--                                                                                       required--}}
{{--                                                                                       placeholder="how many boxes in PU"/><br/>--}}
{{--                                                                                <input type="number" class="form-control"--}}
{{--                                                                                       name="acc_count"--}}
{{--                                                                                       max="{{ $PU->voter_count }}" required--}}
{{--                                                                                       placeholder="how many voters accredited total"/><br/>--}}
{{--                                                                                <button class="btn btn-primary"--}}
{{--                                                                                        type="submit">Submit--}}
{{--                                                                                </button>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                    @else--}}
{{--                                                                        <div class="alert alert-warning">--}}
{{--                                                                            <p>You cannot update this PU</p>--}}
{{--                                                                        </div>--}}
{{--                                                                    @endif--}}
{{--                                                                @endif--}}
{{--                                                            @else--}}
{{--                                                                <div>--}}
{{--                                                                    <span--}}
{{--                                                                        class="h5 bg-{{getTurnClass($PU->accreditation_percentage)}} px-2">{{ $PU->accredited_voters }} Voters Accredited</span>--}}
{{--                                                                    <br />--}}
{{--                                                                    <span--}}
{{--                                                                        class="text-{{getTurnClass($PU->turnout, false)}} px-2">{{ $PU->turnout }}% turnout</span>--}}
{{--                                                                </div>--}}
{{--                                                            @endif--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
{{--                                                    @if($PU->accredited_voters)--}}
{{--                                                        <tr>--}}
{{--                                                            <th>Accreditation Submitted by</th>--}}
{{--                                                            <td></td>--}}
{{--                                                            <td>{{ $PU->AccreditationResult->User->name }}</td>--}}
{{--                                                        </tr>--}}
{{--                                                    @endif--}}
{{--                                                </table>--}}
{{--                                            </form>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="bg-white p-3" style="border-radius: 8px;">
                                            <div class="text-center text-primary h3">VOTING</div>
                                            @if(!true)
                                                <div class="alert alert-warning text-center">
                                                    Accreditation must be completed before voting results can be
                                                    published
                                                </div>
                                            @else
                                                @if($PU->VotingResults->count() > 0)
                                                    <div class="alert alert-success">
                                                        <table class="table">
                                                            @foreach($PU->VotingResults as $Result)
                                                                <tr>
                                                                    <td>({{ $Result->Party->slug }}) {{ $Result->Party->name }}</td>
                                                                    <td>{{ $Result->count }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                @else
                                                <div>
                                                    <form action="{{ route('submit_results', $PU->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        <p class="h4 text-center">{{ $PU->name }}</p>
                                                        <table class="text-black table table-striped">
                                                            <colgroup>
                                                                <col width="50%" />
                                                            </colgroup>
                                                            @foreach(PoliticalParty::orderBy('weight', 'desc')->orderBy('name')->get() as $Party)
                                                                <tr>
                                                                    <th>{{ $Party->slug }}</th>
                                                                    <td>
                                                                        <input type="number" name="vote_tally[{{$Party->id}}]" class="form-control" value="0" />
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td></td>
                                                                <td><button type="submit" class="btn btn-success">Submit</button></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </div>
                                                @endif
                                            @endif
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
