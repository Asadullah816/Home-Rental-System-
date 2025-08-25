<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    // List properties (simple filters optional)
    public function index(Request $request)
    {
        $q = Property::query()->latest();

        if ($request->filled('listing_type')) {
            $q->where('listing_type', $request->string('listing_type'));
        }
        if ($request->filled('city')) {
            $q->where('city', 'like', '%' . $request->string('city') . '%');
        }
        if ($request->filled('is_published')) {
            $q->where('is_published', (bool)$request->boolean('is_published'));
        }

        return response()->json($q->paginate(12));
    }
    public function showproperty()
    {
        // Fetch latest properties with pagination (12 per page)
        $properties = Property::latest()->paginate(12);

        return view('pages.properties', compact('properties'));
    }


    // Create property (manual assignment, uses Storage for images)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'           => ['required', 'string', 'max:150'],
            'listing_type'    => ['required', Rule::in(['rent', 'sale'])],
            'price'           => ['nullable', 'numeric', 'min:0'],
            'currency'        => ['nullable', 'string', 'size:3'],
            'city'            => ['nullable', 'string', 'max:100'],
            'address'         => ['nullable', 'string', 'max:255'],
            'area_size'       => ['nullable', 'numeric', 'min:0'],
            'area_unit'       => ['nullable', 'string', 'max:20'],
            'bedrooms'        => ['nullable', 'integer', 'min:0', 'max:50'],
            'bathrooms'       => ['nullable', 'integer', 'min:0', 'max:50'],
            'description'     => ['nullable', 'string'],

            'contact_name'    => ['required', 'string', 'max:100'],
            'contact_phone'   => ['required', 'string', 'max:30'],
            'whatsapp_phone'  => ['nullable', 'string', 'max:30'],
            'contact_email'   => ['nullable', 'email', 'max:150'],

            'main_image'      => ['nullable', 'image', 'max:2048'],
            'images.*'        => ['nullable', 'image', 'max:2048'],
        ]);

        $property = new Property();

        // Manual assignment (no mass assignment)
        $property->title          = $validated['title'];
        $property->listing_type   = $validated['listing_type'];
        $property->price          = $validated['price'] ?? null;
        $property->currency       = $validated['currency'] ?? 'PKR';
        $property->city           = $validated['city'] ?? null;
        $property->address        = $validated['address'] ?? null;
        $property->area_size      = $validated['area_size'] ?? null;
        $property->area_unit      = $validated['area_unit'] ?? null;
        $property->bedrooms       = $validated['bedrooms'] ?? null;
        $property->bathrooms      = $validated['bathrooms'] ?? null;
        $property->description    = $validated['description'] ?? null;

        $property->contact_name   = $validated['contact_name'];
        $property->contact_phone  = $validated['contact_phone'];
        $property->whatsapp_phone = $validated['whatsapp_phone'] ?? null;
        $property->contact_email  = $validated['contact_email'] ?? null;

        // If you’re using auth, you can set user_id like:
        if ($request->user()) {
            $property->user_id = $request->user()->id;
        }

        // Store main image
        if ($request->hasFile('main_image')) {
            $property->main_image = $request->file('main_image')->store('properties', 'public');
        }

        // Store gallery images (JSON array of paths)
        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $img) {
                $paths[] = $img->store('properties', 'public');
            }
            $property->images = json_encode($paths);
        }

        // Published by default (can change later)
        $property->is_published = true;

        $property->save();

        return redirect('properties');
    }

    // Show one property
    public function show(Property $property)
    {
        return response()->json($property);
    }

    // Update property (manual assignment, replace images if new provided)
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title'           => ['sometimes', 'string', 'max:150'],
            'listing_type'    => ['sometimes', Rule::in(['rent', 'sale'])],
            'price'           => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'currency'        => ['sometimes', 'nullable', 'string', 'size:3'],
            'city'            => ['sometimes', 'nullable', 'string', 'max:100'],
            'address'         => ['sometimes', 'nullable', 'string', 'max:255'],
            'area_size'       => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'area_unit'       => ['sometimes', 'nullable', 'string', 'max:20'],
            'bedrooms'        => ['sometimes', 'nullable', 'integer', 'min:0', 'max:50'],
            'bathrooms'       => ['sometimes', 'nullable', 'integer', 'min:0', 'max:50'],
            'description'     => ['sometimes', 'nullable', 'string'],

            'contact_name'    => ['sometimes', 'string', 'max:100'],
            'contact_phone'   => ['sometimes', 'string', 'max:30'],
            'whatsapp_phone'  => ['sometimes', 'nullable', 'string', 'max:30'],
            'contact_email'   => ['sometimes', 'nullable', 'email', 'max:150'],

            'is_published'    => ['sometimes', 'boolean'],

            'main_image'      => ['sometimes', 'nullable', 'image', 'max:2048'],
            'images.*'        => ['sometimes', 'nullable', 'image', 'max:2048'],
        ]);

        // Manual field-by-field updates
        foreach (
            [
                'title',
                'listing_type',
                'price',
                'currency',
                'city',
                'address',
                'area_size',
                'area_unit',
                'bedrooms',
                'bathrooms',
                'description',
                'contact_name',
                'contact_phone',
                'whatsapp_phone',
                'contact_email',
                'is_published'
            ] as $field
        ) {
            if ($request->has($field)) {
                $property->{$field} = $validated[$field] ?? null;
            }
        }

        // Replace main image if a new one is uploaded
        if ($request->hasFile('main_image')) {
            if ($property->main_image && Storage::disk('public')->exists($property->main_image)) {
                Storage::disk('public')->delete($property->main_image);
            }
            $property->main_image = $request->file('main_image')->store('properties', 'public');
        }

        // Replace gallery images if new ones are uploaded
        if ($request->hasFile('images')) {
            // (Optional) delete old gallery images
            if ($property->images) {
                foreach (json_decode($property->images, true) as $old) {
                    if ($old && Storage::disk('public')->exists($old)) {
                        Storage::disk('public')->delete($old);
                    }
                }
            }
            $paths = [];
            foreach ($request->file('images') as $img) {
                $paths[] = $img->store('properties', 'public');
            }
            $property->images = json_encode($paths);
        }

        $property->save();

        return response()->json([
            'message' => 'Property updated',
            'data'    => $property,
        ]);
    }

    // Soft delete
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json([
            'message' => 'Property deleted',
        ]);
    }

    // Quick publish toggle (optional helper)
    public function togglePublish(Property $property)
    {
        $property->is_published = !$property->is_published;
        $property->save();

        return response()->json([
            'message' => 'Publish status updated',
            'is_published' => $property->is_published,
        ]);
    }
    public function search(Request $request)
    {
        $query = \App\Models\Property::query();

        if ($request->filled('location')) {
            $query->where('city', 'like', '%' . $request->location . '%')
                ->orWhere('neighborhood', 'like', '%' . $request->location . '%')
                ->orWhere('zip', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', $request->bathrooms);
        }

        if ($request->filled('area_min')) {
            $query->where('area', '>=', $request->area_min);
        }

        if ($request->filled('area_max')) {
            $query->where('area', '<=', $request->area_max);
        }

        if ($request->filled('furnished')) {
            $query->where('furnished', $request->furnished);
        }

        $properties = $query->get();
        return view('pages.properties', compact('properties'));
    }
    public function propertydetails($id)
    {
        $property = Property::find($id);
        return view('pages.property_details', compact('property'));
    }
}
