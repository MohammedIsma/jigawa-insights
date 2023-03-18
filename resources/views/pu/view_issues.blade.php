@php use App\Models\PoliticalParty; @endphp
@extends('layouts.app')

@section('content')
    <div class="my-devices-area ml-4">
        <div class="container-fluid">
            <div class="content-sright">
                <div class="my-file-area">
                    <div class="quick-access">
                        <div class="row">
                            <div class="col-4">
                                <p class="h5 text-warning">SUBMIT ISSUE REPORT</p>
                                <table class="table text-white">
                                    <tr>
                                        <th>LGA</th>
                                        <td>{{ $PU->LGA->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>WARD</th>
                                        <td>{{ $PU->Ward->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>POLLING UNIT</th>
                                        <td>{{ $PU->number }}</td>
                                    </tr>
                                    <tr>
                                        <th>POLLING UNIT</th>
                                        <td>{{ $PU->name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-8">
                                <p class="h3 text-white">Incidents List</p>
                                    <div class="bg-white text-black p-3" style="border-radius: 8px;">
                                        <ul>
                                        @foreach($PU->Incidents as $Incident)
                                            <li>
                                                #{{ $Incident->ident }} -
                                                {{ $Incident->created_at->format("h:ia") }} -
                                                @if($Incident->resolved_at)<span class="badge bg-success badge-success">resolved</span> -@endif
                                                @if(!$Incident->resolved_at)<span class="badge bg-danger badge-danger">not resolved</span> -@endif
                                                {{ $Incident->description }}
                                            </li>
                                        @endforeach
                                        </ul>
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
