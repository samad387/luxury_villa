<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transport;
use Illuminate\Support\Facades\Storage;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->get('type');
        $query = Transport::query();
        if ($type) {
            $query->where('type', $type);
        }
        $transports = $query->orderBy('created_at', 'desc')->paginate(12);
        return view('admin.transports.index', compact('transports', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->get('type');
        return view('admin.transports.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:voiture,moto,vip',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'nullable|numeric',
            'capacity' => 'nullable|integer|min:1',
            'images.*' => 'nullable|image|max:2048',
        ]);
        $transport = Transport::create($request->except('images'));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('transports', 'public');
                $transport->images()->create(['path' => $path]);
            }
        }
        return redirect()->route('admin.transports.index', ['type' => $data['type']])->with('success', 'Transport ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transport $transport)
    {
        return view('admin.transports.show', compact('transport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        return view('admin.transports.edit', compact('transport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transport $transport)
    {
        $data = $request->validate([
            'type' => 'required|in:voiture,moto,vip',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'nullable|numeric',
            'capacity' => 'nullable|integer|min:1',
            'images.*' => 'nullable|image|max:2048',
        ]);
        $transport->update($request->except('images'));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('transports', 'public');
                $transport->images()->create(['path' => $path]);
            }
        }
        return redirect()->route('admin.transports.index', ['type' => $data['type']])->with('success', 'Transport modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transport)
    {
        $type = $transport->type;
        if ($transport->image) {
            Storage::disk('public')->delete($transport->image);
        }
        $transport->delete();
        return redirect()->route('admin.transports.index', ['type' => $type])->with('success', 'Transport supprimé avec succès.');
    }
}
