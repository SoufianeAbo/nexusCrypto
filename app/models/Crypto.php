<?php
class Crypto {
    public function getCryptoMarketData($apiKey)
    {
        $apiUrl = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $apiUrl .= '?CMC_PRO_API_KEY=' . $apiKey;

        // Initialize cURL session
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_CAINFO, 'C:/Users/mohamed/Desktop/cacert.pem');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return ['error' => 'Error in cURL request: ' . curl_error($ch)];
        }

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if the API request was successful
        if ($data && isset($data['status'], $data['data']) && $data['status']['error_code'] === 0) {
            return $data['data'];
        } else {
            return ['error' => 'Error fetching market data'];
        }
    }

    public function fetchTopGainers($apiKey, $limit = 10)
    {
        $apiUrl = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?limit=$limit&sort=percent_change_24h&CMC_PRO_API_KEY=$apiKey";

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CAINFO, 'C:/Users/mohamed/Desktop/cacert.pem');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return ['error' => 'Error in cURL request: ' . curl_error($ch)];
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if ($data && isset($data['data'])) {

            return $data['data'];
        } else {
            return ['error' => 'Error fetching top gainers data.'];
        }
    }
}




