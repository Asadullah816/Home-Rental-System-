@extends('layouts.layout')
@section('content')
    <header class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1>{{ $property->title }}</h1>
                    <p class="location"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</p>
                    <div class="property-meta">
                        <span class="meta-item"><i class="fas fa-bed"></i> {{ $property->bedrooms }} Bedrooms</span>
                        <span class="meta-item"><i class="fas fa-bath"></i> {{ $property->bathrooms }} Bathrooms</span>
                        <span class="meta-item"><i class="fas fa-ruler-combined"></i> {{ $property->area }} sq ft</span>
                        <span class="meta-item"><i class="fas fa-car"></i> {{ $property->parking }} Parking</span>
                    </div>
                </div>
                <div class="col-md-5 text-md-end mt-4 mt-md-0">
                    <div class="property-price mb-3">
                        ${{ number_format($property->price) }}
                        <span>{{ $property->type === 'rent' ? '/month' : '/sale' }}</span>
                    </div>
                    <div class="property-actions">
                        <button class="btn btn-outline-light me-2"><i class="far fa-heart"></i> Save</button>
                        <button class="btn btn-outline-light me-2"><i class="fas fa-share-alt"></i> Share</button>
                        <button class="btn btn-outline-light"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
            <nav aria-label="breadcrumb" class="mt-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item"><a href="">Property Listings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $property->title }}</li>
                </ol>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <section class="property-detail-section py-5">
        <div class="container">
            <!-- Property Gallery -->
            <div class="property-gallery mb-5">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="property-main-image">
                            <img src="{{ asset('storage/' . $property->main_image) }}" alt="{{ $property->title }}"
                                class="img-fluid rounded-lg">
                            <div class="image-zoom-icon">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row g-3">
                            @if ($property->gallery && count($property->gallery) > 0)
                                @foreach ($property->gallery as $image)
                                    <div class="col-6 col-md-12">
                                        <div class="property-thumbnail" data-src="{{ asset('storage/' . $image) }}">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image"
                                                class="img-fluid rounded-lg">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-12">
                                <button class="btn btn-outline-primary btn-sm w-100 view-all-photos">
                                    <i class="fas fa-images me-2"></i> View All Photos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Property Details -->
                <div class="col-lg-8">
                    <!-- Overview -->
                    <div class="property-section mb-5">
                        <h2 class="section-title">Overview</h2>
                        <p>{{ $property->description }}</p>
                    </div>

                    <!-- Features & Amenities -->
                    <div class="property-section mb-5">
                        <h2 class="section-title">Features & Amenities</h2>
                        {!! $property->features !!}
                    </div>

                    <!-- Floor Plan -->
                    <div class="property-section mb-5">
                        <h2 class="section-title">Floor Plan</h2>
                        @if ($property->floor_plan)
                            <div class="floor-plan-container">
                                <img src="{{ asset('storage/' . $property->floor_plan) }}" alt="Floor Plan"
                                    class="img-fluid mb-3">
                            </div>
                        @endif
                    </div>

                    <!-- Location -->
                    <div class="property-section mb-5">
                        <h2 class="section-title">Location</h2>
                        <div class="location-map ratio ratio-16x9 mb-3">
                            <iframe src="https://maps.google.com/maps?q={{ urlencode($property->location) }}&output=embed"
                                width="100%" height="450" style="border:0;" allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Contact Info -->
                    <div class="sidebar-widget contact-widget">
                        <h3>Interested in this property?</h3>
                        <p><strong>Contact:</strong> {{ $property->contact_phone }}</p>
                        <p><strong>WhatsApp:</strong> {{ $property->whatsapp_phone }}</p>
                        <p><strong>Email:</strong> {{ $property->contact_email }}</p>
                    </div>

                    <!-- Property Details Summary -->
                    <div class="sidebar-widget details-widget">
                        <h3>Property Details</h3>
                        <ul class="details-list">
                            <li><span class="detail-label">Property ID</span> <span
                                    class="detail-value">{{ $property->id }}</span></li>
                            <li><span class="detail-label">Type</span> <span
                                    class="detail-value">{{ ucfirst($property->type) }}</span></li>
                            <li><span class="detail-label">Bedrooms</span> <span
                                    class="detail-value">{{ $property->bedrooms }}</span></li>
                            <li><span class="detail-label">Bathrooms</span> <span
                                    class="detail-value">{{ $property->bathrooms }}</span></li>
                            <li><span class="detail-label">Area</span> <span class="detail-value">{{ $property->area }} sq
                                    ft</span></li>
                            <li><span class="detail-label">Parking</span> <span
                                    class="detail-value">{{ $property->parking }}</span></li>
                            <li><span class="detail-label">Available From</span> <span
                                    class="detail-value">{{ $property->available_from }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
