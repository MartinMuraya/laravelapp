<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    // Show all services
    public function index()
    {
        // Fetch all services from the database
        $services = Service::all();

        // Pass to the Blade view
        return view('services', compact('services'));
    }
}
