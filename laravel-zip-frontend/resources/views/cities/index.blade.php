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

<!-- Filters Section -->
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Filters</h5>
        <form method="GET" action="{{ route('cities.index') }}" class="row g-3">
            <!-- Search Filter -->
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name or ZIP..." 
                       value="{{ request('search') }}">
            </div>

            <!-- County Filter -->
            <div class="col-md-3">
                <select name="county_filter" class="form-select">
                    <option value="">All Counties</option>
                    @forelse($counties as $county)
                        <option value="{{ $county['id'] }}" {{ request('county_filter') == $county['id'] ? 'selected' : '' }}>
                            {{ $county['name'] }}
                        </option>
                    @empty
                        <option disabled>No counties</option>
                    @endforelse
                </select>
            </div>

            <!-- Alphabetical Filter -->
            <div class="col-md-3">
                <select name="letter" class="form-select">
                    <option value="">All Letters</option>
                    @foreach(range('A', 'Z') as $letter)
                        <option value="{{ $letter }}" {{ request('letter') == $letter ? 'selected' : '' }}>
                            {{ $letter }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Buttons -->
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-grow-1">Filter</button>
                <a href="{{ route('cities.index') }}" class="btn btn-secondary">Clear</a>
            </div>
        </form>
    </div>
</div>

<!-- Results Information -->
@if(!empty($pagination))
    <div class="alert alert-info mb-3">
        Showing <strong>{{ count($cities) }}</strong> cities 
        @if(request('search')) matching "{{ request('search') }}" @endif
        @if(request('county_filter')) in selected county @endif
        @if(request('letter')) starting with {{ request('letter') }} @endif
        (Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }})
    </div>
@endif

<!-- Cities Table -->
<div class="row">
    <div class="col-lg-12">
        @if(count($cities) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>County</th>
                            <th>ZIP Code</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{ $city["id"] ?? "N/A" }}</td>
                                <td><strong>{{ $city["name"] ?? "N/A" }}</strong></td>
                                <td>
                                    @php
                                        $county = collect($counties)->firstWhere('id', $city["county_id"]);
                                    @endphp
                                    {{ $county['name'] ?? 'N/A' }}
                                </td>
                                <td>{{ $city["zip"] ?? "N/A" }}</td>
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

            <!-- Pagination Controls -->
            @if(!empty($pagination) && $pagination['last_page'] > 1)
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <!-- Previous Button -->
                        @if($pagination['current_page'] > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('cities.index', array_merge(request()->query(), ['page' => $pagination['current_page'] - 1])) }}">
                                    Previous
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @endif

                        <!-- Page Numbers -->
                        @for($page = 1; $page <= $pagination['last_page']; $page++)
                            @if($page >= $pagination['current_page'] - 2 && $page <= $pagination['current_page'] + 2)
                                @if($page == $pagination['current_page'])
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ route('cities.index', array_merge(request()->query(), ['page' => $page])) }}">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @elseif(($page == $pagination['current_page'] - 3 || $page == $pagination['current_page'] + 3) && $page > 1 && $page < $pagination['last_page'])
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endfor

                        <!-- Next Button -->
                        @if($pagination['current_page'] < $pagination['last_page'])
                            <li class="page-item">
                                <a class="page-link" href="{{ route('cities.index', array_merge(request()->query(), ['page' => $pagination['current_page'] + 1])) }}">
                                    Next
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        @else
            <div class="alert alert-info text-center py-5">
                <h5>No cities found</h5>
                @if(request('search') || request('county_filter') || request('letter'))
                    <p class="text-muted mb-0">Try adjusting your filters</p>
                @else
                    <p class="text-muted mb-0">Start by adding your first city</p>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
