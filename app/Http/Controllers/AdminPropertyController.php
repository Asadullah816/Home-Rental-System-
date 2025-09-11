<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class AdminPropertyController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        return view('pages.admin_property', compact('properties'));
    }

    public function approve($id)
    {
        $property = Property::find($id);
        $property->sold = true;
        $property->save();

        return back()->with('success', 'Property approved!');
    }

    public function disapprove($id)
    {
        $property = Property::find($id);
        $property->is_published = false;
        $property->save();

        return back()->with('success', 'Property disapproved!');
    }

    public function destroy($id)
    {
        $property = Property::find($id);
        $property->delete();

        return back()->with('success', 'Property deleted!');
    }
}
