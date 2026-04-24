<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Database\QueryException;

class ActivityController extends Controller
{
    public function index()
    {
        try {
            $activities = Activity::with('images')->latest()->get();
        } catch (QueryException $e) {
            // Table absente: afficher la page sans résultats plutôt que planter
            $activities = collect();
        }
        return view('activite', compact('activities'));
    }

    public function show(Activity $activity)
    {
        $activity->load('images');
        return view('public.activities.show', compact('activity'));
    }
}


