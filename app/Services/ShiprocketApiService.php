<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShiprocketApiService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = env('SHIPROCKET_BASE_URL');  
        $this->token = $this->authenticate();  
    }

    /**
     * Authenticate with the Shiprocket API and retrieve the token.
     *
     * @return string|null
     */
    public function authenticate()
    {
        $response = Http::post($this->baseUrl . 'auth/login', [
            'email' => env('SHIPROCKET_USERNAME'),
            'password' => env('SHIPROCKET_PASSWORD'),
        ]);

        if ($response->successful()) {
            return $response->json()['token'];
        }

        // Log the error or throw an exception if needed
        \Log::error('Shiprocket authentication failed', ['response' => $response->json()]);
        return null;
    }

    /**
     * Create an order in Shiprocket.
     *
     * @param array $orderData
     * @return \Illuminate\Http\Response
     */
    public function createOrder(array $orderData)
    {
        // Ensure authentication token is available
        if (!$this->token) {
            return response()->json(['error' => 'Authentication failed'], 401);
        }

        // Send the request to create the order
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post($this->baseUrl . 'orders/create/confirm', $orderData);

        // Check if the response is successful
        if ($response->successful()) {
            return $response->json();  // Return JSON data if the order creation is successful
        }

        // Handle failure - log the error and return the response
        \Log::error('Shiprocket order creation failed', ['response' => $response->json()]);
        return response()->json(['error' => 'Failed to create order', 'details' => $response->json()], $response->status());
    }
}
