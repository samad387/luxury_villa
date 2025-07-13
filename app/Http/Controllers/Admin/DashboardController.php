<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Villa; // Import your models to get counts
use App\Models\Riad;
use App\Models\Appartement;
use App\Models\User;

class DashboardController extends Controller
{

    /**
     * Display the admin dashboard overview.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch any data needed for the dashboard overview.
        // For a simple overview, you might just get counts of your main resources.
        $totalVillas = Villa::count();
        $totalRiads = Riad::count();
        $totalAppartements = Appartement::count();
        $totalUsers = User::count(); // Assuming you want to show total users too

        // You can fetch more complex data here, e.g., recent activities, sales charts data.
        // $recentVillas = Villa::latest()->take(5)->get();

        // Return the dashboard view, passing any data you've fetched.
        return view('admin.dashboard', compact('totalVillas', 'totalRiads', 'totalAppartements', 'totalUsers'));
    }
}
