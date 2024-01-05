<?php

class CryptoController {
    public function index() {
        require_once '../app/models/Cryptocurrency.php';
        $cryptoModel = new Crypto();

        $apiKey = 'c8328ac7-3c86-4a07-baec-8d7a6728e626';
        $cryptoData = $cryptoModel->getCryptoData($apiKey);

        require_once '../app/views/pages/landing.php';
    }
}