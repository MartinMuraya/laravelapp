<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function stkPush(Request $request)
    {
        // Here you will integrate the MPESA STK Push
        // For now, return a dummy response:
        return response()->json([
            'message' => 'STK Push initiated. (Dummy response)'
        ]);
    }
}
