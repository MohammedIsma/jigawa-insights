
 @extends('layouts.app')

@section('content')
<div class="p-3">
<h2>@if($units['ward'] !="")
    {{$units['ward']}}  Ward
    @endif 
    Polling Units</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Polling Unit</th>
              <th scope="col">Map</th>
            </tr>
          </thead>
          <tbody>
           @foreach($units['units'] as $unit)
            <tr>
                <td> {{$unit->id}} </td>
                <td> {{$unit->pu_name}} </td>
                <td> 
                    <a class="text-decoration-none" href="{{ url('#') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">view</a>
            </td>
            </tr>
           @endforeach
     </tbody>
  </table>
      </div>
      @endsection