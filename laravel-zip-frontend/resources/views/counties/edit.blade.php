@extends("layouts.app")

@section("title", "Edit County")

@section("content")
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h1 class="mb-4">Edit County</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route("counties.update", $county["id"]) }}" method="POST">
                    @csrf
                    @method("PUT")

                    <div class="mb-3">
                        <label for="name" class="form-label">County Name *</label>
                        <input type="text" class="form-control @error("name") is-invalid @enderror" 
                               id="name" name="name" value="{{ old("name", $county["name"] ?? "") }}" required>
                        @error("name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Update County</button>
                        <a href="{{ route("counties.index") }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
