@extends('layouts.app')

@section('content')
<div class="row  text-center text-decoration-none">
     <div class="col p-4">
        <a href="{{ url('state/1') }}" class="text-decoration-none">
        <div class="card mb-5 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-bg-primary border-primary">
            <h4 class="my-0 fw-normal">Registered States   </h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$totals['state']}} <small class="text-muted fw-light">State</small></h1>
            
          </div>
        </div>
        </a>
      </div>

      <div class="col p-4">
      <a href="{{ url('lga') }}" class="text-decoration-none">
        <div class="card mb-5 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-bg-primary border-primary">
            <h4 class="my-0 fw-normal">Registered LGAs   </h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$totals['lga']}} <small class="text-muted fw-light">LGAs</small></h1>
            
          </div>
        </div>
      </a>
      </div>
      <div class="col p-4">
      <a href="{{ url('ward') }}" class="text-decoration-none">
        <div class="card mb-5 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-bg-primary border-primary">
            <h4 class="my-0 fw-normal">Registered Wards   </h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$totals['ward']}} <small class="text-muted fw-light">Wards</small></h1>
            
          </div>
        </div>
      </a>
      </div>
      <div class="col p-4">
      <a href="{{ url('unit') }}" class="text-decoration-none">
        <div class="card mb-5 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-bg-primary border-primary">
            <h4 class="my-0 fw-normal">Total Polling Units   </h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$totals['unit']}} <small class="text-muted fw-light"> PUnit</small></h1>
            
          </div>
        </div>
      </a>
      </div>
</div>
@endsection