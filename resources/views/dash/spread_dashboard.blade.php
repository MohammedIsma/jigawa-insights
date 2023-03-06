@extends('layouts.app-dashboard')

@section('Content')
    <spread-dashboard-component lgaid="{{ $lgaid }}" wardid="{{ $wardid }}" puid="{{ $puid }}"></spread-dashboard-component>
@endsection
