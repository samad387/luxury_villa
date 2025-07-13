<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Villa;
use App\Models\Image; // Import the Image model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Support\Facades\Validator; // For manual validation in store/update if needed

class VillaController extends Controller
{
    public function index()
    {
        // Fetch all villas with their associated images, paginated
        $villas = Villa::with('images')->paginate(10);
        return view('admin.villas.index', compact('villas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.villas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'geo_emplacement' => 'nullable|string', // e.g., "latitude,longitude"
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Validate each image
        ]);

        // 2. Create the Villa
        $villa = Villa::create($request->except('images')); // Create villa, excluding images from mass assignment

        // 3. Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // Store image in 'public/villas' directory and get its path
                $path = $imageFile->store('villas', 'public');

                // Create a record in the images table, linked polymorphically
                $villa->images()->create([
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.villas.index')
                         ->with('success', 'Villa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Villa $villa)
    {
        // Eager load images for display
        $villa->load('images');
        return view('admin.villas.show', compact('villa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Villa $villa)
    {
        // Eager load images for display in the edit form
        $villa->load('images');
        return view('admin.villas.edit', compact('villa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Villa $villa)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'geo_emplacement' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'existing_images_to_delete' => 'nullable|array', // Array of image IDs to delete
            'existing_images_to_delete.*' => 'exists:images,id', // Ensure IDs exist
        ]);

        // 2. Update the Villa
        $villa->update($request->except(['images', 'existing_images_to_delete']));

        // 3. Handle deletion of existing images
        if ($request->has('existing_images_to_delete')) {
            foreach ($request->input('existing_images_to_delete') as $imageId) {
                $image = Image::find($imageId);
                if ($image && $image->imageable_id === $villa->id && $image->imageable_type === Villa::class) {
                    // Delete file from storage
                    Storage::disk('public')->delete($image->path);
                    // Delete image record from database
                    $image->delete();
                }
            }
        }

        // 4. Handle new image uploads (same logic as store)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('villas', 'public');
                $villa->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.villas.index')
                         ->with('success', 'Villa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Villa $villa)
    {
        // The `booted` method in the Villa model handles image deletion before the villa record is deleted.
        $villa->delete();

        return redirect()->route('admin.villas.index')
                         ->with('success', 'Villa deleted successfully.');
    }
}
