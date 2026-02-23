@extends("layouts.app")

@section("title", "County Details")

@section("content")
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="mb-4">
            <a href="{{ route("counties.index") }}" class="btn btn-secondary">&larr; Back to Counties</a>
        </div>

        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="mb-0">{{ $county["name"] ?? "N/A" }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>ID:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $county["id"] ?? "N/A" }}
                    </div>
                </div>

                @if(isset($county["created_at"]))
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <strong>Created:</strong>
                    </div>
                    <div class="col-sm-8">
                        {{ $county["created_at"] }}
                    </div>
                </div>
                @endif

                <hr>

                <div class="d-flex gap-2">
                    <a href="{{ route("counties.edit", $county["id"]) }}" class="btn btn-warning">Edit</a>
                    <form method="POST" action="{{ route("counties.destroy", $county["id"]) }}" style="display: inline;">
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
