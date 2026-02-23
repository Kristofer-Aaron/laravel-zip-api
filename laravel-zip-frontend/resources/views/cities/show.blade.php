@extends("layouts.app")

@section("title", "City Details")

@section("content")
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="mb-4">
            <a href="{{ route("cities.index") }}" class="btn btn-secondary">&larr; Back to Cities</a>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">{{ $city["name"] ?? "N/A" }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>ID:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $city["id"] ?? "N/A" }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>County ID:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $city["county_id"] ?? "N/A" }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Postal Code:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $city["postal_code"] ?? "N/A" }}
                    </div>
                </div>

                @if(isset($city["created_at"]))
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $city["created_at"] }}
                    </div>
                </div>
                @endif

                <hr>

                <div class="d-flex gap-2">
                    <a href="{{ route("cities.edit", $city["id"]) }}" class="btn btn-warning">Edit</a>
                    <form method="POST" action="{{ route("cities.destroy", $city["id"]) }}" style="display: inline;">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger" onclick="return confirm(\"Are you sure?\")">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
