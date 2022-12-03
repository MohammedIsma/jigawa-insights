@extends('layouts.app')

@section('content')
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="p-3">
<h2>Officials</h2>
<br>
<br><br>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#exampleModal">Add Official</button>

<br><br>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Official</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="addOfficialForm ", method="post", action="{{route('officials.store')}}" enctype="multipart/form-data">
      @csrf <!-- {{ csrf_field() }} -->
      <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Name</label>
  <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter name...">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Phone Number</label>
  <input type="number" name="phone_number" class="form-control" id="exampleFormControlInput1" placeholder="Enter name...">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Designation</label>
  <input type="text" name="designation" class="form-control" id="exampleFormControlInput1" placeholder="Enter name...">
</div>
<div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">Official</label>
<select class="form-select" name="official_type_id" aria-label="Default select example">
    <option selected>None</option>
@foreach (App\Models\OfficialType::all() as $officialType)
  <option value="{{$officialType->slug}}">{{$officialType->name}}</option>
  @endforeach
</select>
</div><div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">State</label>
<select class="form-select" name="state_id" aria-label="Default select example">
@if(isset($state))    
<option value="{{$state->name}}" selected>{{$state->name}}</option>
@else
  <option selected>None</option>
  @foreach(App\Models\State::all() as $state)
  <option value="{{$state->id}}">{{$state->name}}</option>
  @endforeach
  @endif
</select>
</div>
<div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">LGA</label>
<select class="form-select" name="lga_id" aria-label="Default select example">
@if(isset($lga))    
<option value="{{$lga->name}}" selected>{{$lga->name}}</option>
@else
  <option selected>None</option>
  @foreach(App\Models\LGA::all() as $lga)
  <option value="{{$lga->id}}">{{$lga->name}}</option>
  @endforeach
  @endif
</select>
</div>
<div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">Ward</label>
<select class="form-select" name="ward_id" aria-label="Default select example">
@if(isset($ward))    
<option value="{{$ward->name}}" selected>{{$ward->name}}</option>
@else
  <option selected>None</option>
  @foreach(App\Models\Ward::all() as $ward)
  <option value="{{$ward->id}}">{{$ward->name}}</option>
  @endforeach
  @endif
</select>
</div>
<div class="mb-3">
<label for="exampleFormControlInput1" class="form-label">Polling Unit</label>
<select class="form-select" name="unit_id" aria-label="Default select example">
@if(isset($unit))    
<option value="{{$unit->name}}" selected>{{$unit->name}}</option>
@else
  <option selected>None</option> 
  @foreach(App\Models\PollingUnit::all() as $unit)
  <option value="{{$unit->id}}">{{$unit->name}}</option>
  @endforeach
  @endif
</select>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="submit" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>
      <div class="table-responsive">
        <table class="table table-striped ">
          <thead>
            <tr>
              <th scope="col">name</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Official</th>
              <th scope="col">Designation</th>
              <th scope="col">State</th>
              <th scope="col">LGA</th>
              <th scope="col">Ward</th>
              <th scope="col">Polling Unit</th>
            </tr>
          </thead>
          <tbody>
           @foreach($officials as $official)
            <tr>
                <td> {{$official->name}} </td>
                <td> {{$official->phone_number}} </td>
                <td> {{$official->official}} </td>
                <td> {{$official->designation}} </td>
                <td> {{$official->designation}} </td>
                <td> {{$official->designation}} </td>
                <td> {{$official->designation}} </td>
                <td> {{$official->designation}} </td>
            </tr>
           @endforeach
     </tbody>
  </table>
      </div>
      @endsection