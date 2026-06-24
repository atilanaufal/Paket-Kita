<?php



use Illuminate\Support\Facades\Http;


if (!function_exists('fetchTrackingInfo')) {
    function fetchTrackingInfo($awb, $courier)
    {
        $apiKey = '185c6fa0fc2320874b416289e60209d6beb2513606ad1cb72e1839ef2392f9e4';
        $url = "https://api.binderbyte.com/v1/track?api_key={$apiKey}&courier={$courier}&awb={$awb}";

        try {
            $response = Http::get($url);
            return $response->json();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Unable to connect to the API'];
        }
    }
}


