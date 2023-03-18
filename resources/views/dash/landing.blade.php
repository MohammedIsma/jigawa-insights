@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 col-md-4 offset-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <p class="h4 text-success">Which dashboard would you like to view?</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <div class="m-4"><a href="/dash-/accreditation" class="btn btn-block btn-primary py-3" style="width: 100%;">Reporting Progress Dashboard</a></div>
                    <div class="m-4"><a href="/dash-/tally" class="btn btn btn-primary py-3" style="width: 100%;">Tally Dashboard</a></div>
                    <div class="m-4"><a href="/dash-/prob" class="btn btn-primary py-3" style="width: 100%;">Incidence Dashboard</a></div>
                    <div class="m-4"><a href="/dash-/scoreboard" class="btn btn-primary py-3" style="width: 100%;">Scoreboard</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
