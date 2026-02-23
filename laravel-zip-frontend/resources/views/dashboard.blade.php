@extends("layouts.app")

@section("title", "Dashboard")

@section("content")
<div class="row mb-4">
    <div class="col-lg-12">
        <h1 class="mb-2">Welcome back, {{ Auth::user()->name }}! </h1>
        <p class="lead text-muted">Manage Hungarian cities and counties efficiently</p>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-primary">
            <div class="card-body text-center">
                <h5 class="card-title" style="font-size: 2rem;"></h5>
                <h3 class="card-subtitle mb-3">Manage Cities</h3>
                <p class="card-text text-muted">View, create, edit, and delete cities with their postal codes</p>
                <a href="{{ route("cities.index") }}" class="btn btn-primary btn-lg">Go to Cities </a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card border-success">
            <div class="card-body text-center">
                <h5 class="card-title" style="font-size: 2rem;"></h5>
                <h3 class="card-subtitle mb-3">Manage Counties</h3>
                <p class="card-text text-muted">View, create, edit, and delete counties</p>
                <a href="{{ route("counties.index") }}" class="btn btn-success btn-lg">Go to Counties </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">About This Application</h5>
                <p class="card-text">
                    This is a frontend application to manage Hungarian cities and counties. 
                    It communicates with a Laravel API backend running on <code>http://localhost:8000/api</code>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
