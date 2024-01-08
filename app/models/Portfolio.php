<?php
// QuantityCryptoModel.php

class QuantityCryptoModel {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'nexus');

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getCryptoDataByUserID($userID) {
        $cryptoData = array();

        $query = "SELECT * FROM quantitycrypto WHERE userID = $userID";
        $result = $this->db->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cryptoData[] = $row;
            }
            $result->free();
        } else {
            echo "Error: " . $this->db->error;
        }

        return $cryptoData;
    }

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
        $data = json_decode($response, true);
        return $data['data'];
    }
}
?>