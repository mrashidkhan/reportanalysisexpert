@extends('layout.master')

@section('content')

    {{-- @include('partials.slidersection') --}}

    @include('partials.whatwedo')
    @include('partials.pricing')
    @include('partials.upload')
    @include('partials.departments')

    @include('partials.contactsection')
    @include('partials.clientsection')

@include('partials.aboutsection')
    {{-- @include('medical-reports.upload') --}}
     {{-- @include('partials.doctorsection') --}}
     {{-- @include('partials.reportuploadsection') --}}



@endsection
