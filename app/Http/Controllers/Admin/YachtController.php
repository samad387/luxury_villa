<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Yacht;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class YachtController extends Controller
{
    public function index()
    {
        // Fetch all yachts with their associated images, paginated
        $yachts = Yacht::with('images')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.yachts.index', compact('yachts'));
    }

    public function create()
    {
        return view('admin.yachts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'length_meters' => 'required|numeric|min:0',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,bmp|max:2048',
            'images.*' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,bmp|max:2048',
            'active' => 'boolean'
        ]);

        // Handle active checkbox
        $data['active'] = $request->has('active') ? 1 : 0;

        // Handle old single image for backward compatibility
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('yachts', 'public');
        }

        // Create the Yacht
        $yacht = Yacht::create($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('yachts', 'public');
                $yacht->images()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('admin.yachts.index')->with('success', 'Yacht ajouté avec succès');
    }

    public function edit(Yacht $yacht)
    {
        // Eager load images for display in the edit form
        $yacht->load('images');
        return view('admin.yachts.edit', compact('yacht'));
    }

    public function update(Request $request, Yacht $yacht)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'length_meters' => 'required|numeric|min:0',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp,bmp|max:2048',
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
            if ($yacht->image && Storage::disk('public')->exists($yacht->image)) {
                Storage::disk('public')->delete($yacht->image);
            }
            $data['image'] = $request->file('image')->store('yachts', 'public');
        } else {
            // Keep existing image if no new image uploaded
            unset($data['image']);
        }

        // Update the Yacht
        $yacht->update($data);

        // Handle deletion of existing images
        if ($request->has('existing_images_to_delete')) {
            foreach ($request->input('existing_images_to_delete') as $imageId) {
                $image = Image::find($imageId);
                if ($image && $image->imageable_id === $yacht->id && $image->imageable_type === Yacht::class) {
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
                $path = $imageFile->store('yachts', 'public');
                $yacht->images()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('admin.yachts.index')->with('success', 'Yacht mis à jour avec succès');
    }

    public function destroy(Yacht $yacht)
    {
        // Images will be deleted automatically via the booted() method in the Yacht model
        $yacht->delete();
        
        return redirect()->route('admin.yachts.index')->with('success', 'Yacht supprimé avec succès');
    }
}
