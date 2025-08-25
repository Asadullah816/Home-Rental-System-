@extends('layouts.layout')
@section('content')
    <header class="hero-section">
        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-4">Find Your Dream Home</h1>
            <p class="lead mb-5">Discover thousands of properties for rent in your area</p>
            <div class="search-container">
                <form action="{{ route('properties.search') }}" method="get">
                    <div class="row g-3">
                        <div class="col-12 col-md-5">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="City, Neighborhood, or ZIP"
                                    required>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <select class="form-select">
                                <option selected>Property Type</option>
                                <option>Apartment</option>
                                <option>House</option>
                                <option>Villa</option>
                                <option>Commercial</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <select class="form-select">
                                <option selected>Price Range</option>
                                <option>$500 - $1000</option>
                                <option>$1000 - $2000</option>
                                <option>$2000 - $3000</option>
                                <option>$3000+</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                    <div class="advanced-search mt-2">
                        <a href="#" data-bs-toggle="collapse" data-bs-target="#advancedOptions">
                            Advanced Search <i class="fas fa-chevron-down ms-1"></i>
                        </a>
                        <div id="advancedOptions" class="collapse mt-3">
                            <div class="row g-3">
                                <div class="col-md-3 col-6">
                                    <label class="form-label">Bedrooms</label>
                                    <select class="form-select">
                                        <option>Any</option>
                                        <option>1+</option>
                                        <option>2+</option>
                                        <option>3+</option>
                                        <option>4+</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label">Bathrooms</label>
                                    <select class="form-select">
                                        <option>Any</option>
                                        <option>1+</option>
                                        <option>2+</option>
                                        <option>3+</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label">Area (sq ft)</label>
                                    <select class="form-select">
                                        <option>Any</option>
                                        <option>500+</option>
                                        <option>1000+</option>
                                        <option>1500+</option>
                                        <option>2000+</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label">Furnished</label>
                                    <select class="form-select">
                                        <option>Any</option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <!-- Features Section -->
    <section class="features-section py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Why Choose HomeHaven</h2>
                <p>The easiest way to find and rent your next home</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <h3>Wide Selection</h3>
                        <p>Thousands of verified properties available for rent across multiple locations.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Verified Listings</h3>
                        <p>All our properties and owners are thoroughly verified for your safety.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3>Direct Communication</h3>
                        <p>Connect directly with property owners and managers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Properties -->
    <section class="featured-properties py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Featured Properties</h2>
                <p>Handpicked properties you might love</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="property-card">
                        <div class="property-img">
                            <span class="property-label">Featured</span>
                            <img src="https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg"
                                alt="Luxury Apartment" class="img-fluid">
                            <div class="property-tags">
                                <span class="tag"><i class="fas fa-bed"></i> 3</span>
                                <span class="tag"><i class="fas fa-bath"></i> 2</span>
                                <span class="tag"><i class="fas fa-ruler-combined"></i> 1,200 sq ft</span>
                            </div>
                        </div>
                        <div class="property-info">
                            <h3><a href="pages/property-detail.html">Luxury Downtown Apartment</a></h3>
                            <p class="location"><i class="fas fa-map-marker-alt"></i> Manhattan, NY</p>
                            <div class="price">$2,800/month</div>
                            <p class="description">Modern luxury apartment with stunning city views, hardwood floors,
                                and high-end appliances.</p>
                            <div class="property-footer">
                                <a href="pages/property-detail.html" class="btn btn-outline-primary btn-sm">View
                                    Details</a>
                                <button class="btn btn-link favorite-btn"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="property-card">
                        <div class="property-img">
                            <span class="property-label">New</span>
                            <img src="https://images.pexels.com/photos/1396122/pexels-photo-1396122.jpeg"
                                alt="Modern Townhouse" class="img-fluid">
                            <div class="property-tags">
                                <span class="tag"><i class="fas fa-bed"></i> 4</span>
                                <span class="tag"><i class="fas fa-bath"></i> 3</span>
                                <span class="tag"><i class="fas fa-ruler-combined"></i> 2,000 sq ft</span>
                            </div>
                        </div>
                        <div class="property-info">
                            <h3><a href="pages/property-detail.html">Modern Suburban Townhouse</a></h3>
                            <p class="location"><i class="fas fa-map-marker-alt"></i> San Francisco, CA</p>
                            <div class="price">$3,500/month</div>
                            <p class="description">Spacious townhouse with private garage, backyard patio, and
                                renovated kitchen.</p>
                            <div class="property-footer">
                                <a href="pages/property-detail.html" class="btn btn-outline-primary btn-sm">View
                                    Details</a>
                                <button class="btn btn-link favorite-btn"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="property-card">
                        <div class="property-img">
                            <span class="property-label">Hot</span>
                            <img src="https://images.pexels.com/photos/323780/pexels-photo-323780.jpeg" alt="Cozy Studio"
                                class="img-fluid">
                            <div class="property-tags">
                                <span class="tag"><i class="fas fa-bed"></i> 1</span>
                                <span class="tag"><i class="fas fa-bath"></i> 1</span>
                                <span class="tag"><i class="fas fa-ruler-combined"></i> 650 sq ft</span>
                            </div>
                        </div>
                        <div class="property-info">
                            <h3><a href="pages/property-detail.html">Cozy Downtown Studio</a></h3>
                            <p class="location"><i class="fas fa-map-marker-alt"></i> Austin, TX</p>
                            <div class="price">$1,200/month</div>
                            <p class="description">Newly renovated studio apartment with great natural light and modern
                                amenities.</p>
                            <div class="property-footer">
                                <a href="pages/property-detail.html" class="btn btn-outline-primary btn-sm">View
                                    Details</a>
                                <button class="btn btn-link favorite-btn"><i class="far fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="pages/listings.html" class="btn btn-primary">View All Properties</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>What Our Customers Say</h2>
                <p>Hear from people who found their perfect home with us</p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p>"HomeHaven made finding my apartment so easy. The search filters were helpful, and I
                                loved being able to chat directly with the landlord."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg" alt="James Wilson"
                                class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h5>James Wilson</h5>
                                <p>New York</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p>"As a property owner, I've had great success listing my rentals here. The platform is
                                user-friendly and I get quality inquiries."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg"
                                alt="Sarah Johnson" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h5>Sarah Johnson</h5>
                                <p>Los Angeles</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p>"I found my dream house through HomeHaven. The detailed property descriptions and photos
                                helped me narrow down my choices before even visiting."</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg"
                                alt="Michael Rodriguez" class="testimonial-avatar">
                            <div class="testimonial-info">
                                <h5>Michael Rodriguez</h5>
                                <p>Chicago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-3">Ready to List Your Property?</h2>
                    <p class="mb-0">Join thousands of property owners who have successfully rented their properties
                        through HomeHaven.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="pages/post-property.html" class="btn btn-light btn-lg">List Your Property</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile App Promotion -->
    <section class="app-promotion py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2>Take HomeHaven With You</h2>
                    <p class="lead mb-4">Download our mobile app to search properties on the go, get instant
                        notifications, and manage your listings from anywhere.</p>
                    <div class="app-badges">
                        <a href="#" class="me-3"><img
                                src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Download_on_the_App_Store_Badge.svg"
                                alt="App Store" height="40"></a>
                        <a href="#"><img
                                src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                                alt="Google Play" height="40"></a>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="https://images.pexels.com/photos/4123897/pexels-photo-4123897.jpeg" alt="Mobile App"
                        class="img-fluid rounded app-screenshot">
                </div>
            </div>
        </div>
    </section>
@endsection
