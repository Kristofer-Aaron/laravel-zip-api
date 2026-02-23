@extends("layouts.app")

@section("title", "Register")

@section("content")
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="mb-4 text-center">Create Account</h1>

        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Something went wrong.
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route("register.post") }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" class="form-control @error("name") is-invalid @enderror" 
                               id="name" name="name" value="{{ old("name") }}" required autofocus>
                        @error("name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control @error("email") is-invalid @enderror" 
                               id="email" name="email" value="{{ old("email") }}" required>
                        @error("email")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" class="form-control @error("password") is-invalid @enderror" 
                               id="password" name="password" required>
                        @error("password")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="d-block text-muted mt-1">At least 6 characters</small>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password *</label>
                        <input type="password" class="form-control @error("password_confirmation") is-invalid @enderror" 
                               id="password_confirmation" name="password_confirmation" required>
                        @error("password_confirmation")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success w-100 btn-lg">Create Account</button>
                </form>

                <hr>

                <div class="text-center">
                    <p class="mb-0">Already have an account? <a href="{{ route("login") }}" class="text-decoration-none">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
