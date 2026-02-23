@extends("layouts.app")

@section("title", "Edit City")

@section("content")
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h1 class="mb-4">Edit City</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route("cities.update", $city["id"]) }}" method="POST">
                    @csrf
                    @method("PUT")

                    <div class="mb-3">
                        <label for="name" class="form-label">City Name *</label>
                        <input type="text" class="form-control @error("name") is-invalid @enderror" 
                               id="name" name="name" value="{{ old("name", $city["name"] ?? "") }}" required>
                        @error("name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="county_id" class="form-label">County *</label>
                        <select class="form-select @error("county_id") is-invalid @enderror" 
                                id="county_id" name="county_id" required>
                            <option value="">Select a county...</option>
                            @forelse($counties as $county)
                                <option value="{{ $county["id"] }}" 
                                    {{ old("county_id", $city["county_id"] ?? "") == $county["id"] ? "selected" : "" }}>
                                    {{ $county["name"] }} (ID: {{ $county["id"] }})
                                </option>
                            @empty
                                <option disabled>No counties available</option>
                            @endforelse
                        </select>
                        @error("county_id")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="zip" class="form-label">ZIP Code</label>
                        <input type="text" class="form-control @error("zip") is-invalid @enderror" 
                               id="zip" name="zip" value="{{ old("zip", $city["zip"] ?? "") }}">
                        @error("zip")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Update City</button>
                        <a href="{{ route("cities.index") }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
