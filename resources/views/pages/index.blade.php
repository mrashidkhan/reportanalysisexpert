@extends('layout.master')

@section('content')

    {{-- @include('partials.slidersection') --}}

    @include('partials.upload')
    @include('partials.whatwedo')
    @include('partials.pricing')

    @include('partials.departments')
    @include('partials.aboutsection')
    @include('partials.contactsection')
    @include('partials.clientsection')


    {{-- @include('medical-reports.upload') --}}
     {{-- @include('partials.doctorsection') --}}
     {{-- @include('partials.reportuploadsection') --}}



@endsection
