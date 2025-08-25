@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/listings.css') }}">
@endsection
@section('content')
    <header class="page-header">
        <div class="container">
            <h1>Find Your Perfect Property</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Property Listings</li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <section class="properties-section py-5">
        <div class="container">
            <div class="row">
                <!-- Filters Sidebar -->

                <!-- Properties Content -->
                <div class="col">
                    <div class="properties-header d-flex justify-content-between align-items-center mb-4">
                        <div class="properties-count">
                            Showing <span>{{ $properties->count() }}</span> of <span>{{ $properties->total() }}</span>
                            properties
                        </div>
                        <div class="properties-tools d-flex align-items-center">
                            <div class="view-switcher me-3">
                                <button class="btn btn-sm btn-outline-primary active" data-view="grid">
                                    <i class="fas fa-th-large"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" data-view="list">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                            <div class="sorting-options">
                                <form method="GET" action="">
                                    <select class="form-select" name="sort" onchange="this.form.submit()">
                                        <option value="recent">Most Recent</option>
                                        <option value="price-asc">Price (Low to High)</option>
                                        <option value="price-desc">Price (High to Low)</option>
                                        <option value="area-asc">Area (Small to Large)</option>
                                        <option value="area-desc">Area (Large to Small)</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Properties Grid -->
                    <div class="row properties-grid">
                        @foreach ($properties as $property)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="property-card">
                                    <div class="property-img">
                                        @if ($property->featured)
                                            <span class="property-label">Featured</span>
                                        @endif
                                        <img src="{{ asset('storage/' . $property->main_image) }}"
                                            alt="{{ $property->title }}" class="img-fluid">
                                        <div class="property-tags">
                                            <span class="tag"><i class="fas fa-bed"></i> {{ $property->bedrooms }}</span>
                                            <span class="tag"><i class="fas fa-bath"></i>
                                                {{ $property->bathrooms }}</span>
                                            <span class="tag"><i class="fas fa-ruler-combined"></i> {{ $property->area }}
                                                sq ft</span>
                                        </div>
                                    </div>
                                    <div class="property-info">
                                        <h3><a
                                                href="{{ route('propertydetails', ['id' => $property->id]) }}">{{ $property->title }}</a>
                                        </h3>
                                        <p class="location"><i class="fas fa-map-marker-alt"></i> {{ $property->city }}</p>
                                        <div class="price">${{ number_format($property->price) }}</div>
                                        <p class="description">{{ Str::limit($property->description, 100) }}</p>
                                        <div class="property-footer">
                                            <a href="{{ route('propertydetails', ['id' => $property->id]) }}"
                                                class="btn btn-outline-primary btn-sm">
                                                View Details
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Properties pagination" class="mt-4">
                        {{ $properties->links('pagination::bootstrap-5') }}
                    </nav>
                </div>

            </div>
        </div>
    </section>
@endsection
