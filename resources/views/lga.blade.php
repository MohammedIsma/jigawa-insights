@extends('layouts.app')

@section('content')
<div class="p-3">
<h2>{{$lgas['state']}} Local Government Areas </h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">LGA</th>
              <th scope="col">Ward</th>
              <th scope="col">Polling Unit</th>
            </tr>
          </thead>
          <tbody>
           @foreach($lgas['lgas'] as $lg)
            <tr>
                <td> {{$lg->id}} </td>
                <td> {{$lg->local_name}} </td>
                <td> {{$lg->ward_count}} Wards
                    <a class="text-decoration-none" href="{{ url('/ward/'.$lg->id.'/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">View</a>
            </td>
                <td> {{$lg->polling_unit_count}} PU
                    <a class="text-decoration-none" href="{{ url('/unit/'.$lg->id.'/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">View</a>
            </td>
            </tr>
           @endforeach
     </tbody>
  </table>
</div>
@endsection