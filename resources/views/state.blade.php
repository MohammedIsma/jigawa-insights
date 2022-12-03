@extends('layouts.app')

@section('content')
<div class="p-3">
<h2>States</h2>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead>
            <tr>
              <th scope="col">State Name</th>
              <th scope="col">Show LGAs</th>
              <th scope="col">Official</th>
            </tr>
          </thead>
          <tbody>
           @foreach($state as $st)
            <tr>
                <td> {{$st->name}} </td>
                <td> 
                    <a class="text-decoration-none" href="{{ url('/lga/'.$st->id.'/') }} " class="text-sm text-gray-700 dark:text-gray-500 underline">View</a>
            </td>
            <td> 
                    <a class="text-decoration-none" href="{{ url('/state/officials/'.$st->id.'/') }} " class="text-sm text-gray-700 dark:text-gray-500 underline">View</a>
            </td>
            </tr>
           @endforeach
     </tbody>
  </table>
      </div>
      @endsection