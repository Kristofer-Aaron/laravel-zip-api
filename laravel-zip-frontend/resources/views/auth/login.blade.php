@extends("layouts.app")

@section("title", "Login")

@section("content")
<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="mb-4 text-center">Login</h1>

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

                <form method="POST" action="{{ route("login.post") }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control @error("email") is-invalid @enderror" 
                               id="email" name="email" value="{{ old("email") }}" required autofocus>
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
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-lg">Login</button>
                </form>

                <hr>

                <div class="text-center">
                    <p class="mb-0">Don't have an account? <a href="{{ route("register") }}" class="text-decoration-none">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
