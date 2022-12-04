@extends('layouts.app')

@section('content')
    <div class="default-table-area">
        <div class="container-fluid">
            <div class="card-box-style">
                <div class="others-title">
                    <h3>Polling Units' Data</h3>
                </div>

                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Polling Unit</th>
                        <th scope="col">Ward</th>
                        <th scope="col">LGA</th>
                        <th scope="col">Voters</th>
                        <th scope="col">Confidence Level</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($PUs as $PU)
                    <tr>
                        <th scope="row">{{ $PU->name }}</th>
                        <td>{{ $PU->Ward->name }}</td>
                        <td>{{ $PU->LGA->name }}</td>
                        <td>0</td>
                        <td><em>unranked</em></td>
                        <td class="text-end"><a href="#">details</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
