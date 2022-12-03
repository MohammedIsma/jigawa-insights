
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
              <th scope="col">Polling Unit</th>
              <th scope="col">Officials</th>
              <th scope="col">Map</th>
            </tr>
          </thead>
          <tbody>
           @foreach($units['units'] as $unit)
            <tr>
                <td> {{$unit->name}} </td>
                <td> 
                    <a class="text-decoration-none" href="{{ url('/unit/officials/'.$unit->id.'/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">view</a>
            </td><td> 
                    <a class="text-decoration-none" href="{{ url('#') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">view</a>
            </td>
            </tr>
           @endforeach
     </tbody>
  </table>
      </div>
      @endsection