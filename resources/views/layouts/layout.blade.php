<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HomeHaven | Find Your Perfect Rental</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @yield('style')
</head>

<body>
    @php
        function setActive($routeName)
        {
            return request()->routeIs($routeName) ? 'active' : '';
        }
    @endphp
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('showproperties') }}">
                <span class="brand-text">HomeHaven</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ setActive('home') }}" href="">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ setActive('showproperties') }}" href="">
                            Properties
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ setActive('addproperty') }}" href="{{ route('property.form') }}">
                            List Property
                        </a>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="">
                            About
                        </a>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            Contact
                        </a>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-envelope"></i>
                            <span class="badge bg-danger message-badge">3</span>
                        </a>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a class="nav-link login-btn" href="#">
                            Login / Register
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->

    @yield('content')
    <!-- Footer -->
    <footer class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-4">HomeHaven</h5>
                    <p>We're on a mission to make property rentals simple, transparent, and accessible to everyone.</p>
                    <div class="social-links mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5 class="mb-4">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="pages/listings.html">Properties</a></li>
                        <li><a href="pages/post-property.html">List Property</a></li>
                        <li><a href="pages/about.html">About Us</a></li>
                        <li><a href="pages/contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5 class="mb-4">Resources</h5>
                    <ul class="footer-links">
                        <li><a href="pages/faqs.html">FAQs</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Rental Guides</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                    <h5 class="mb-4">Newsletter</h5>
                    <p>Subscribe to our newsletter for the latest property listings and updates.</p>
                    <form class="newsletter-form">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Your email" required>
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2025 HomeHaven. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed with <i class="fas fa-heart text-danger"></i> by Bolt</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
