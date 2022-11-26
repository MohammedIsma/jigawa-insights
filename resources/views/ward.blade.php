@extends('layouts.app')

@section('content')
<div class="p-3">
<h2>
     Wards</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Ward</th>
              <th scope="col">Polling Unit</th>
            </tr>
          </thead>
          <tbody>
           @foreach($wards['wards'] as $ward)
            <tr>
                <td> {{$ward->id}} </td>
                <td> {{$ward->ward_name}} </td>
                <td> {{$ward->polling_unit_count}} PU
                    <a class="text-decoration-none" href="{{ url('/unit/'.$ward->id.'/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">View</a>
            </td>
            </tr>
           @endforeach
     </tbody>
  </table>
      </div>
      @endsection
