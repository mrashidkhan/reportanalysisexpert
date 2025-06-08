@extends('layout.master')

@section('content')

    @include('partials.slidersection')
    @include('partials.departments')
    {{-- @include('partials.reportuploadsection') --}}
    @include('partials.aboutsection')
    {{-- @include('medical-reports.upload') --}}
     @include('partials.doctorsection')
     @include('partials.contactsection')
     @include('partials.clientsection')



@endsection
