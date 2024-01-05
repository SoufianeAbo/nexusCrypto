<?php
class Crypto {
    public function getCryptoData($apiKey) {
        $endpoint = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $ch = curl_init($endpoint . '?start=1&limit=100');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'X-CMC_PRO_API_KEY: ' . $apiKey,
            'Accept: application/json',
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
?>