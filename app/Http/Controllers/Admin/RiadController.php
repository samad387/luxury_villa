<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Riad;
use App\Models\Image; // Import the Image model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Support\Facades\Validator; // For manual validation in store/update if needed

class RiadController extends Controller
{
    public function index()
    {
        // Fetch all Riads with their associated images, paginated
        $riads = Riad::with('images')->paginate(10);
        return view('admin.riads.index', compact('riads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.riads.create');
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

        // 2. Create the Riad
        $Riad = Riad::create($request->except('images')); // Create Riad, excluding images from mass assignment

        // 3. Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // Store image in 'public/Riads' directory and get its path
                $path = $imageFile->store('Riads', 'public');

                // Create a record in the images table, linked polymorphically
                $Riad->images()->create([
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.riads.index')
                         ->with('success', 'Riad created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Riad $riad)
    {
        // Eager load images for display
        $riad->load('images');
        return view('admin.riads.show', compact('riad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Riad $riad)
    {
        // Eager load images for display in the edit form
        $riad->load('images');
        return view('admin.riads.edit', compact('riad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Riad $Riad)
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

        // 2. Update the Riad
        $Riad->update($request->except(['images', 'existing_images_to_delete']));

        // 3. Handle deletion of existing images
        if ($request->has('existing_images_to_delete')) {
            foreach ($request->input('existing_images_to_delete') as $imageId) {
                $image = Image::find($imageId);
                if ($image && $image->imageable_id === $Riad->id && $image->imageable_type === Riad::class) {
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
                $path = $imageFile->store('Riads', 'public');
                $Riad->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.riads.index')
                         ->with('success', 'Riad updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Riad $Riad)
    {
        // The `booted` method in the Riad model handles image deletion before the Riad record is deleted.
        $Riad->delete();

        return redirect()->route('admin.riads.index')
                         ->with('success', 'Riad deleted successfully.');
    }
}
