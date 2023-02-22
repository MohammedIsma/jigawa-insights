@extends('layouts.app')

@section('content')
<div class="row text-decoration-none">
     <div class="col-12 col-md-4">
        <div class="card mb-5 rounded-3 shadow-sm border-primary text-left">
          <div class="card-header py-3 text-bg-primary border-primary">
            <h4 class="my-0 fw-normal">Your Profile</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th><td>{{ auth()->user()->name }}</td>
                </tr>
                <tr>
                    <th>Responsibility</th>
                    <td>
                        <table width="100%">
                        <?php $l = "";?>
                        @foreach(auth()->user()->AllowedWards() as $W)
                                @if($W->lga_id!=$l)
                                    <tr><th colspan="2"><strong><u>{{ $W->LGA->name }} LG</u></strong></th></tr>
                                    <?php $l = $W->lga_id;?>
                                @endif
                                <tr>
                                    <td>&middot; <a href="/ward/{{ $W->id }}">{{ $W->name }}</a></td>
                                    <td style="text-align:right;">
                                        @if($W->accreditation_percentage==100)
                                            <span class="text-success">
                                                <i class="fa fa-pen-alt"></i>
                                                <small><small>accreditation done</small></small>
                                            </span>
                                        @else
                                            <span class="text-warning">
                                                <i class="fa fa-pen-alt"></i>
                                                <small>{{ $W->accreditation_percentage }}%</small>
                                            </span>
                                        @endif
                                        <span class="text-warning"><i class="fa fa-vote-yea"></i></span>
                                    </td>
                                </tr>
                            </tr>
                        @endforeach
                        </table>
                    </td>
                </tr>
            </table>
          </div>
        </div>
      </div>
    <div class="col-12 col-md-8">
        <div class="card mb-5 rounded-3 shadow-sm border-primary text-left">
          <div class="card-body">

          </div>
        </div>
      </div>
</div>
@endsection
