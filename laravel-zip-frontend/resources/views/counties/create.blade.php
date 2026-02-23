@extends("layouts.app")

@section("title", "Create County")

@section("content")
<div class="row">
    <div class="col-lg-6 mx-auto">
        <h1 class="mb-4">Add New County</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route("counties.store") }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">County Name *</label>
                        <input type="text" class="form-control @error("name") is-invalid @enderror" 
                               id="name" name="name" value="{{ old("name") }}" required>
                        @error("name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Create County</button>
                        <a href="{{ route("counties.index") }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
