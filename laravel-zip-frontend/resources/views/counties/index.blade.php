@extends("layouts.app")

@section("title", "Counties")

@section("content")
<div class="row mb-4">
    <div class="col-lg-8">
        <h1>Counties</h1>
    </div>
    <div class="col-lg-4 text-end">
        <a href="{{ route("counties.create") }}" class="btn btn-success btn-lg">+ Add County</a>
    </div>
</div>

@if(isset($error))
    <div class="alert alert-warning">{{ $error }}</div>
@endif

<div class="row">
    <div class="col-lg-12">
        @if(count($counties) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($counties as $county)
                            <tr>
                                <td>{{ $county["id"] ?? "N/A" }}</td>
                                <td><strong>{{ $county["name"] ?? "N/A" }}</strong></td>
                                <td>
                                    <div class="btn-group-action">
                                        <a href="{{ route("counties.show", $county["id"]) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route("counties.edit", $county["id"]) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route("counties.destroy", $county["id"]) }}" style="display: inline;">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\"Are you sure?\")">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center py-5">
                <h5>No counties found</h5>
                <p class="text-muted mb-0">Start by adding your first county</p>
            </div>
        @endif
    </div>
</div>
@endsection
