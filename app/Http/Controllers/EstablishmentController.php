<?php

namespace App\Http\Controllers;

use App\Models\Villa;
use App\Models\Riad;
use App\Models\Appartement;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of all establishments (Villas, Riads, Appartements).
     */
    public function index(Request $request)
    {
        // Get filter parameters from request
        $type = $request->get('type', '');
        $minPrice = $request->get('minPrice');
        $maxPrice = $request->get('maxPrice');
        $capacity = $request->get('capacity');
        $searchName = $request->get('searchName', '');

        // Fetch all villas, riads, and appartements with their first image
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
        $allEstablishments = collect()
            ->merge($villas)
            ->merge($riads)
            ->merge($appartements);

        // Apply filters
        $filteredEstablishments = $allEstablishments->filter(function($establishment) use ($type, $minPrice, $maxPrice, $capacity, $searchName) {
            // Filter by type
            if (!empty($type) && $establishment->type !== $type) {
                return false;
            }

            // Filter by price range
            if (!empty($minPrice) && $establishment->price < $minPrice) {
                return false;
            }
            if (!empty($maxPrice) && $establishment->price > $maxPrice) {
                return false;
            }

            // Filter by capacity
            if (!empty($capacity) && $establishment->capacity < $capacity) {
                return false;
            }

            // Filter by name (search)
            if (!empty($searchName) && stripos($establishment->name, $searchName) === false) {
                return false;
            }

            return true;
        });

        // Pagination: 20 items per page
        $perPage = 20;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $items = $filteredEstablishments->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        // Create paginator with query string parameters preserved
        $establishments = new LengthAwarePaginator(
            $items,
            $filteredEstablishments->count(),
            $perPage,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );

        // Append query parameters to pagination links
        $establishments->appends($request->query());

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
