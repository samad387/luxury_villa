<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function showMotos()
    {
        $motos = Transport::where('type', 'moto')->with('images')->get();
        return view('location_moto', compact('motos'));
    }

    public function showVoitures()
    {
        $voitures = Transport::where('type', 'voiture')->with('images')->get();
        return view('location_voiture', compact('voitures'));
    }

    public function showVip()
    {
        $vips = Transport::where('type', 'vip')->with('images')->get();
        return view('vip_transport', compact('vips'));
    }

    public function showPublic(\App\Models\Transport $transport)
    {
        $transport->load('images');
        return view('public.transport.show', compact('transport'));
    }
} 