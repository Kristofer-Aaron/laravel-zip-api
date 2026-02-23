@extends("layouts.app")

@section("title", "Cities")

@section("content")
<div class="row mb-4">
    <div class="col-lg-8">
        <h1>Cities</h1>
    </div>
    <div class="col-lg-4 text-end">
        <a href="{{ route("cities.create") }}" class="btn btn-primary btn-lg">+ Add City</a>
    </div>
</div>

@if(isset($error))
    <div class="alert alert-warning">{{ $error }}</div>
@endif

<div class="row">
    <div class="col-lg-12">
        @if(count($cities) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>County ID</th>
                            <th>Postal Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{ $city["id"] ?? "N/A" }}</td>
                                <td><strong>{{ $city["name"] ?? "N/A" }}</strong></td>
                                <td>{{ $city["county_id"] ?? "N/A" }}</td>
                                <td>{{ $city["postal_code"] ?? "N/A" }}</td>
                                <td>
                                    <div class="btn-group-action">
                                        <a href="{{ route("cities.show", $city["id"]) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route("cities.edit", $city["id"]) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route("cities.destroy", $city["id"]) }}" style="display: inline;">
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
                <h5>No cities found</h5>
                <p class="text-muted mb-0">Start by adding your first city</p>
            </div>
        @endif
    </div>
</div>
@endsection
