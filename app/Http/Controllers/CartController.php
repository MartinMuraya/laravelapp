<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $service = Service::findOrFail($request->service_id);

        $cart = session()->get('cart', []);

        // add service to cart or increment quantity
        if(isset($cart[$service->id])) {
            $cart[$service->id]['quantity']++;
        } else {
            $cart[$service->id] = [
                "title" => $service->title,
                "price" => $service->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', "$service->title added to cart!");
    }
}
