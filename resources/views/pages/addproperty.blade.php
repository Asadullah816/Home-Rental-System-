@extends('layouts.layout')
@section('content')
    <header class="page-header">
        <div class="container">
            <h1>List Your Property</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </header>

    <section class="post-property-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="post-property-form bg-white p-4 rounded-lg shadow">

                        {{-- Laravel form --}}
                        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Basic Information -->
                            <div class="section-title mb-4">
                                <h3>Basic Information</h3>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Property Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title') }}" required>
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Listing Type</label>
                                        <select name="listing_type" class="form-select" required>
                                            <option value="">Select Type</option>
                                            <option value="rent" {{ old('listing_type') == 'rent' ? 'selected' : '' }}>Rent
                                            </option>
                                            <option value="sale" {{ old('listing_type') == 'sale' ? 'selected' : '' }}>Sale
                                            </option>
                                        </select>
                                        @error('listing_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="section-title mb-4">
                                <h3>Location</h3>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Property Details -->
                            <div class="section-title mb-4">
                                <h3>Property Details</h3>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Bedrooms</label>
                                    <input type="number" name="bedrooms" class="form-control"
                                        value="{{ old('bedrooms') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Bathrooms</label>
                                    <input type="number" name="bathrooms" class="form-control"
                                        value="{{ old('bathrooms') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Area Size</label>
                                    <input type="number" step="0.01" name="area_size" class="form-control"
                                        value="{{ old('area_size') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Area Unit</label>
                                    <input type="text" name="area_unit" class="form-control"
                                        value="{{ old('area_unit') }}" placeholder="marla, kanal, sqft">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control"
                                        value="{{ old('price') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Currency</label>
                                    <input type="text" name="currency" class="form-control"
                                        value="{{ old('currency', 'PKR') }}">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="section-title mb-4">
                                <h3>Description</h3>
                            </div>
                            <div class="mb-4">
                                <textarea name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                            </div>

                            <!-- Photos -->
                            <div class="section-title mb-4">
                                <h3>Photos</h3>
                            </div>
                            <div class="mb-4">
                                <label>Main Image</label>
                                <input type="file" name="main_image" class="form-control mb-2">
                                <label>Additional Images</label>
                                <input type="file" name="images[]" class="form-control" multiple>
                            </div>

                            <!-- Contact Information -->
                            <div class="section-title mb-4">
                                <h3>Contact Information</h3>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Contact Name</label>
                                    <input type="text" name="contact_name" class="form-control"
                                        value="{{ old('contact_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="contact_email" class="form-control"
                                        value="{{ old('contact_email') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="contact_phone" class="form-control"
                                        value="{{ old('contact_phone') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="text" name="whatsapp_phone" class="form-control"
                                        value="{{ old('whatsapp_phone') }}">
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="mb-4">
                                <label class="form-label">Status</label>
                                <select name="is_published" class="form-select">
                                    <option value="1" {{ old('is_published', 1) == 1 ? 'selected' : '' }}>Published</option>
                                    <option value="0" {{ old('is_published') == 0 ? 'selected' : '' }}>Unpublished</option>
                                </select>
                            </div>

                            <!-- Submit -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit Property</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- @endsection --}}
