<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\Riad;
use App\Models\Appartement;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of all establishments (Villas, Riads, Appartements).
     */
    public function index(Request $request)
    {
        // Fetch all villas, riads, and appartements with their first image
        // We eager-load 'images' and use 'first()' to get only one for the preview
        // For production, consider using a default image if no images exist,
        // or ensure at least one image is uploaded via validation/logic.
        $villas = Villa::with(['images' => function($query) {
            $query->limit(1);
        }])->get()->map(function($villa) {
            $villa->type = 'villa';
            $villa->display_image = $villa->images->first()->path ?? 'https://placehold.co/600x400/cccccc/333333?text=No+Image';
            $villa->detail_route = route('public.villas.show', $villa->id);
            return $villa;
        });

        $riads = Riad::with(['images' => function($query) {
            $query->limit(1);
        }])->get()->map(function($riad) {
            $riad->type = 'riad';
            $riad->display_image = $riad->images->first()->path ?? 'https://placehold.co/600x400/cccccc/333333?text=No+Image';
            $riad->detail_route = route('public.riads.show', $riad->id);
            return $riad;
        });

        $appartements = Appartement::with(['images' => function($query) {
            $query->limit(1);
        }])->get()->map(function($appartement) {
            $appartement->type = 'appartement';
            $appartement->display_image = $appartement->images->first()->path ?? 'https://placehold.co/600x400/cccccc/333333?text=No+Image';
            $appartement->detail_route = route('public.appartements.show', $appartement->id);
            return $appartement;
        });

        // Combine all establishments into a single collection
        $establishments = collect()
            ->merge($villas)
            ->merge($riads)
            ->merge($appartements);

        // Optional: Apply server-side filtering based on request parameters
        // This is important if you expect a very large number of establishments
        // and want to avoid sending all of them to the frontend initially.
        // For client-side filtering, we just pass all establishments.

        return view('public.establishments.index', compact('establishments'));
    }

    /**
     * Display the specified villa details on a public page.
     */
    public function showVilla(Villa $villa)
    {
        $villa->load('images'); // Load all images for the detail page
        return view('public.establishments.show_villa', compact('villa'));
    }

    /**
     * Display the specified riad details on a public page.
     */
    public function showRiad(Riad $riad)
    {
        $riad->load('images');
        return view('public.establishments.show_riad', compact('riad'));
    }

    /**
     * Display the specified appartement details on a public page.
     */
    public function showAppartement(Appartement $appartement)
    {
        $appartement->load('images');
        return view('public.establishments.show_appartement', compact('appartement'));
    }
}
