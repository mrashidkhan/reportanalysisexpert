@extends('layout.master')

@section('content')
<div class="container mt-5 mb-5">
    <h1 class="text-center mb-4 display-4 font-weight-bold" style="color:black;">Admin Dashboard</h1>

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
        <div class="card-header bg-success text-white py-3">
            <h4 class="mb-0">Medical Reports</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Status</th>
                            <th scope="col">Report Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->phone_number }}</td>
                                <td>{{ $report->status }}</td>
                                <td>{{ $report->created_at->format('M d, Y h:i A') }}</td>
                                <td>
                                    <a href="{{ route('medical-reports.show', $report->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye mr-1" aria-hidden="true"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <p class="lead text-muted">No medical reports found.</p>
                                    <i class="fa fa-folder-open fa-3x text-muted"></i>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for dashboard.blade.php */
   /*  body {
        background-color: #F0F2F5; Light gray background for the entire page
    }

    .container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
    } */

    h1 {
        color: black; /* Bootstrap success green */
        font-weight: 700; /* Bolder heading */
        letter-spacing: 1px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
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
        background-color: #28a745 !important; /* Ensure success green for header */
        border-bottom: none;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card-header h4 {
        font-weight: 600;
    }

    .table {
        margin-bottom: 0; /* Remove bottom margin from table inside card-body */
    }

    .table thead th {
        background-color: #343a40; /* Dark header for table */
        color: white;
        border-bottom: none;
        padding: 15px; /* More padding for table headers */
    }

    .table tbody tr:hover {
        background-color: #e9ecef; /* Light gray on row hover */
        cursor: pointer;
    }

    .table td {
        vertical-align: middle; /* Align content vertically in middle */
        padding: 12px 15px; /* Consistent padding for table cells */
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

    /* Font Awesome icons for buttons */
    .btn .fa {
        margin-right: 5px;
    }
</style>
@endsection
