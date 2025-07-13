<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appartement;
use App\Models\Image; // Import the Image model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Support\Facades\Validator; // For manual validation in store/update if needed

class AppartementController extends Controller
{
    public function index()
    {
        // Fetch all Appartements with their associated images, paginated
        $appartements = Appartement::with('images')->paginate(10);
        return view('admin.appartements.index', compact('appartements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.appartements.create');
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

        // 2. Create the Appartement
        $Appartement = Appartement::create($request->except('images')); // Create Appartement, excluding images from mass assignment

        // 3. Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                // Store image in 'public/Appartements' directory and get its path
                $path = $imageFile->store('Appartements', 'public');

                // Create a record in the images table, linked polymorphically
                $Appartement->images()->create([
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.appartements.index')
                         ->with('success', 'Appartement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appartement $appartement)
    {
        // Eager load images for display
        $appartement->load('images');
        return view('admin.appartements.show', compact('appartement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appartement $appartement)
    {
        // Eager load images for display in the edit form
        $appartement->load('images');
        return view('admin.appartements.edit', compact('appartement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appartement $Appartement)
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

        // 2. Update the Appartement
        $Appartement->update($request->except(['images', 'existing_images_to_delete']));

        // 3. Handle deletion of existing images
        if ($request->has('existing_images_to_delete')) {
            foreach ($request->input('existing_images_to_delete') as $imageId) {
                $image = Image::find($imageId);
                if ($image && $image->imageable_id === $Appartement->id && $image->imageable_type === Appartement::class) {
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
                $path = $imageFile->store('Appartements', 'public');
                $Appartement->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.appartements.index')
                         ->with('success', 'Appartement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appartement $Appartement)
    {
        // The `booted` method in the Appartement model handles image deletion before the Appartement record is deleted.
        $Appartement->delete();

        return redirect()->route('admin.appartements.index')
                         ->with('success', 'Appartement deleted successfully.');
    }
}
