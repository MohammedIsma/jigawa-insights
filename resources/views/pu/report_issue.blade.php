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
                                        <td>{{ $PU->name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-9">
                                <p class="h3 text-white">You are <strong>{{ auth()->user()->name }}</strong></p>
                                <div class="row">
                                    <div class="col-md-7">
                                        <form action="" method="POST" name="frmPostIssue">
                                            @csrf

                                            <div class="bg-white text-black p-3" style="border-radius: 8px;">
                                                <label for="issue_report">DESCRIBE THE ISSUE</label><br />
                                                <textarea name="issue_report" id="issue_report" cols="30" rows="10" required></textarea>
                                                <br />
                                                <button class="btn btn-success" type="submit" name="submit">Submit Issue</button>
                                            </div>

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
@endsection
