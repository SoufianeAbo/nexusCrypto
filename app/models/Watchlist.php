<?php

class Watchlist
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function addToWatchlist($data)
    {

        $query = "SELECT *  FROM watchlistcrypto WHERE CryptoID = :cryptoID AND UserID = :userID";
        $this->db->query($query);
        $this->db->bind(':cryptoID', $data['crypto_id']);
        $this->db->bind(':userID', $data['user_id']);
        $this->db->single();

        if ($this->db->rowCount() > 0) {

            return false;
        }


        $query = "INSERT INTO watchlistcrypto (CryptoID, UserID) VALUES (:cryptoID, :userID)";
        $this->db->query($query);
        $this->db->bind(':cryptoID',  $data['crypto_id']);
        $this->db->bind(':userID', $data['user_id']);
        $this->db->execute();
        return true;
    }
    public function getWatchlistCryptoIds($userId)
    {
        $sql = "SELECT CryptoID FROM watchlistcrypto WHERE UserID = :userId";
        $this->db->query($sql);
        $this->db->bind(':userId', $userId);
        return $this->db->resultSet();
    }
    // Inside your Watchlist model
    public function getWatchlistCryptoData($userId)
    {
        // Get user's watchlist crypto IDs
        $userWatchlist = $this->getWatchlistCryptoIds($userId);

        // Check if the watchlist is not empty
        if (!empty($userWatchlist)) {
            $apiKey = '436015aa-6648-4e76-8e91-6e1ed0ea0bd6';


            foreach ($userWatchlist as $cryptoID) {
                $cryptoData[] = $this->fetchCryptocurrencyData($apiKey, $cryptoID->CryptoID);
            }

            return $cryptoData;
        } else {
            // Return an empty array or handle the case when the watchlist is empty
            return [];
        }
    }

    public function fetchCryptocurrencyData($apiKey, $cryptoID)
    {
        $apiUrl = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest?id=$cryptoID&CMC_PRO_API_KEY=$apiKey";

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
            return $data;
        }
    }

    public function removeFromWatchlist($id)
    {
        $sql = "DELETE watchlistcrypto.* FROM watchlistcrypto WHERE CryptoID = :cryptoId";
        $this->db->query($sql);
        $this->db->bind(':cryptoId', $id);
        return $this->db->resultSet();
    }

}
