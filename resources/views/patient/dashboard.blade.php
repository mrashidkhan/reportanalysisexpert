@extends('layout.master')

@section('content')
<div class="container">
    <h1>Patient Dashboard</h1>

    <div class="mb-4">
        <a href="{{ route('logout') }}" class="btn btn-danger"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="row">
    @if($reports->isEmpty())
        <h1>No Report belongs to User</h1>
    @else
        <table class="table">
        <thead>
            <tr>
                <th>Patient</th>
                <th>Phone</th>
                <th>Age</th>
                <th>Report Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->user->name }}</td>
                    <td>{{ $report->phone_number }}</td>
                    <td>{{ $report->age }}</td>
                    <td>{{ $report->created_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <a href="{{ route('medical-reports.show', $report->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
</div>
@endsection
