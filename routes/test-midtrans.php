<?php

use Illuminate\Support\Facades\Route;
use Midtrans\Config;

Route::get('/test-midtrans', function() {
    try {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Fix SSL certificate issue
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ];

        // Test data
        $params = [
            'transaction_details' => [
                'order_id' => 'TEST-' . time(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '08123456789',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'status' => 'success',
            'message' => 'Midtrans configuration OK!',
            'snap_token' => $snapToken,
            'server_key' => substr(config('midtrans.server_key'), 0, 15) . '...',
            'client_key' => substr(config('midtrans.client_key'), 0, 15) . '...',
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'server_key' => config('midtrans.server_key') ? 'Set' : 'Not set',
            'client_key' => config('midtrans.client_key') ? 'Set' : 'Not set',
        ], 500);
    }
});
