<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jet;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JetController extends Controller
{
    public function index()
    {
        // Fetch all jets with their associated images, paginated
        $jets = Jet::with('images')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.jets.index', compact('jets'));
    }

    public function create()
    {
        return view('admin.jets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'range_km' => 'required|numeric|min:0',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,bmp|max:2048', // Keep for backward compatibility
            'images.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,bmp|max:2048',
            'active' => 'boolean'
        ]);

        // Handle active checkbox
        $data['active'] = $request->has('active') ? 1 : 0;

        // Handle old single image for backward compatibility
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('jets', 'public');
        }

        // Create the Jet
        $jet = Jet::create($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('jets', 'public');
                $jet->images()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('admin.jets.index')->with('success', 'Jet ajouté avec succès');
    }

    public function edit(Jet $jet)
    {
        // Eager load images for display in the edit form
        $jet->load('images');
        return view('admin.jets.edit', compact('jet'));
    }

    public function update(Request $request, Jet $jet)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'range_km' => 'required|numeric|min:0',
            'price_per_hour' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,bmp|max:2048', // Keep for backward compatibility
            'images.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,bmp|max:2048',
            'existing_images_to_delete' => 'nullable|array',
            'existing_images_to_delete.*' => 'exists:images,id',
            'active' => 'boolean'
        ]);

        // Handle active checkbox
        $data['active'] = $request->has('active') ? 1 : 0;

        // Handle old single image for backward compatibility
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($jet->image && Storage::disk('public')->exists($jet->image)) {
                Storage::disk('public')->delete($jet->image);
            }
            $data['image'] = $request->file('image')->store('jets', 'public');
        } else {
            // Keep existing image if no new image uploaded
            unset($data['image']);
        }

        // Update the Jet
        $jet->update($data);

        // Handle deletion of existing images
        if ($request->has('existing_images_to_delete')) {
            foreach ($request->input('existing_images_to_delete') as $imageId) {
                $image = Image::find($imageId);
                if ($image && $image->imageable_id === $jet->id && $image->imageable_type === Jet::class) {
                    // Delete file from storage
                    Storage::disk('public')->delete($image->path);
                    // Delete image record from database
                    $image->delete();
                }
            }
        }

        // Handle new multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('jets', 'public');
                $jet->images()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('admin.jets.index')->with('success', 'Jet mis à jour avec succès');
    }

    public function destroy(Jet $jet)
    {
        // Images will be deleted automatically via the booted() method in the Jet model
        $jet->delete();
        
        return redirect()->route('admin.jets.index')->with('success', 'Jet supprimé avec succès');
    }
}
