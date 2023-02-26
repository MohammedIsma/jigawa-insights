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
                                            <div class="text-center text-primary h4">Have you Reach Agent?</div>
                                            <form action="{{ route('submit_agent', $PU->id) }}" method="POST">
                                                @csrf
                                                <table class="text-black">
                                                    <tr>
                                                        <th>Polling Unit</th>
                                                        <td style="width:50px;"></td>
                                                        <td><p class="h4">{{ $PU->name }}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Agent Phone Number</th>
                                                        <td style="width:50px;"></td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                   name="agent_contact" min=1 max=""
                                                                   required
                                                                   placeholder="Agent Phone number"/>
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
