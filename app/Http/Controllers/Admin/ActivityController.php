<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        try {
        $query = Activity::query();
        if ($category) {
            $query->where('category', $category);
        }
        $activities = $query->orderBy('created_at', 'desc')->paginate(12);
        } catch (QueryException $e) {
            // Si la table n'existe pas, renvoyer une pagination vide pour éviter le crash
            $activities = new LengthAwarePaginator([], 0, 12, 1, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
        }
        return view('admin.activities.index', compact('activities', 'category'));
    }

    public function create(Request $request)
    {
        $category = $request->get('category');
        return view('admin.activities.create', compact('category'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'nullable|numeric',
            'category' => 'nullable|string|max:100',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $activity = Activity::create($request->except('images'));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('activities', 'public');
                $activity->images()->create(['path' => $path]);
            }
        }
        return redirect()->route('admin.activities.index', ['category' => $data['category'] ?? null])
            ->with('success', 'Activité ajoutée avec succès.');
    }

    public function show(Activity $activity)
    {
        return view('admin.activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        // Eager load images for display in the edit form
        $activity->load('images');
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'nullable|numeric',
            'category' => 'nullable|string|max:100',
            'images.*' => 'nullable|image|max:2048',
            'existing_images_to_delete' => 'nullable|array',
            'existing_images_to_delete.*' => 'exists:images,id',
        ]);

        $activity->update($data);

        // Handle deletion of existing images
        if ($request->has('existing_images_to_delete')) {
            foreach ($request->input('existing_images_to_delete') as $imageId) {
                $image = \App\Models\Image::find($imageId);
                if ($image && $image->imageable_id === $activity->id && $image->imageable_type === Activity::class) {
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
                $path = $imageFile->store('activities', 'public');
                $activity->images()->create(['path' => $path]);
            }
        }
        
        return redirect()->route('admin.activities.index', ['category' => $data['category'] ?? null])
            ->with('success', 'Activité modifiée avec succès.');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->image) {
            Storage::disk('public')->delete($activity->image);
        }
        $activity->delete();
        return redirect()->route('admin.activities.index')->with('success', 'Activité supprimée avec succès.');
    }
}







