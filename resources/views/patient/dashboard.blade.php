@extends('layout.master')

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="text-center mb-4" style="color:black;">Patient Dashboard</h1>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('logout') }}" class="btn btn-danger btn-lg shadow-sm"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out mr-2" aria-hidden="true"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Medical Reports</h4>
        </div>
        <div class="card-body">
            @if($reports->isEmpty())
                <div class="alert alert-warning text-center" role="alert">
                    <strong>No reports available for this user.</strong>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
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
                                        <a href="{{ route('medical-reports.show', $report->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye" aria-hidden="true"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    body {
        background-color: #D9F2DE; /* Light gray background for the entire page */
    }

    .container {
        background-color: #52B4A4; /* White background for the main content area */
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Softer shadow */
        padding: 30px; /* More padding inside the container */
    }

    h1 {
        color: black; /* Bootstrap success green */
        font-weight: 700; /* Bolder heading */
        letter-spacing: 1px;
    }

    .btn-danger {
        background-color: #dc3545; /* Bootstrap danger red */
        border-color: #dc3545;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        transform: translateY(-2px); /* Slight lift on hover */
    }

    .card {
        border: none; /* Remove default card border */
        border-radius: 10px; /* Match container border-radius */
    }

    .card-header {
        background-color: #28a745; /* Ensure success green for header */
        border-bottom: none;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .table {
        margin-bottom: 0; /* Remove bottom margin from table inside card-body */
    }

    .table thead th {
        background-color: #343a40; /* Dark header for table */
        color: white;
    }

    .table tbody tr:hover {
        background-color: #e9ecef; /* Light gray on row hover */
        cursor: pointer;
    }

    .table td {
        vertical-align: middle; /* Align content vertically in middle */
    }

    .alert {
        border-radius: 5px; /* Rounded corners for alert */
    }

    .btn-info {
        background-color: #17a2b8; /* Bootstrap info blue */
        border-color: #17a2b8;
        transition: all 0.3s ease;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
        transform: scale(1.05); /* Slightly enlarge on hover */
    }
</style>
@endsection
