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
                                    <tr><th>POLLING UNIT</th><td>{{ $PU->name }}</td></tr>
                                    <tr><th>WARD</th><td>{{ $PU->Ward->name }}</td></tr>
                                    <tr><th>LGA</th><td>{{ $PU->LGA->name }}</td></tr>
                                </table>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bg-white p-3">
                                            <p class="h3">You are <strong>{{ auth()->user()->name }}</strong></p>
                                            <form action="{{ route('submit_accreditation', $PU->id) }}" method="POST">
                                                @csrf
                                                <table class="text-black">
                                                    <tr><th>Polling Unit</th><td style="width:50px;"></td><td><p class="h4">{{ $PU->name }}</p></td></tr>
                                                    <tr><th>Registered Voters</th><td style="width:50px;"></td><td><p class="h6">{{ $PU->voter_count }}</p></td></tr>
                                                    <tr>
                                                        <th>Accredited Voters</th>
                                                        <td style="width:50px;"></td>
                                                        <td>
                                                            @if(!$PU->accredited_voters)
                                                                <div class="alert alert-info">
                                                                    <p>Are you sure of how many voters have been accredited?</p>
                                                                    <div>
                                                                        <input type="number" name="acc_count" max="{{ $PU->voter_count }}" required placeholder="how many voters accredited" />
                                                                        <button class="btn btn-primary" type="submit">Submit</button>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div>
                                                                    <span class="h5 bg-{{getTurnClass($PU->accreditation_percentage)}} px-2">{{ $PU->accredited_voters }} Voters Accredited</span>
                                                                    <span class="text-{{getTurnClass($PU->turnout, false)}} px-2">{{ $PU->turnout }}% turnout</span>
                                                                </div>


                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
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
