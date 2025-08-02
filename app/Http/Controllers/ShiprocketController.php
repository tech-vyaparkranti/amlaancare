<?php

namespace App\Http\Controllers;

use App\Services\ShiprocketApiService;
use Illuminate\Http\Request;

class ShiprocketController extends Controller
{
    protected $shiprocketService;

    public function __construct(ShiprocketApiService $shiprocketService)
    {
        $this->shiprocketService = $shiprocketService;
    }

    /**
     * Authenticate with Shiprocket and retrieve a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate()
    {
        $token = $this->shiprocketService->authenticate();

        if ($token) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['message' => 'Authentication failed'], 400);
    }

    /**
     * Fetch orders from Shiprocket API.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchOrders()
    {
        
        $token = $this->shiprocketService->authenticate();

        if ($token) {
            
            $response = $this->shiprocketService->getOrders($token);
            
            if (isset($response['error'])) {
                return response()->json(['message' => $response['error']], 400);
            }
            
            return response()->json($response); 
        }

        return response()->json(['message' => 'Authentication failed'], 400);
    }
}
