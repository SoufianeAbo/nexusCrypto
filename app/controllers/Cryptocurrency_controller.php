<?php

class CryptoController {
    public function index($argument) {
        require_once '../app/models/Cryptocurrency.php';
        $cryptoModel = new Crypto();

        $apiKey = 'c8328ac7-3c86-4a07-baec-8d7a6728e626';
        $cryptoData = $cryptoModel->getCryptoData($apiKey);
        $toptenData = $cryptoModel->getCryptoDataTop10($apiKey);

        require_once "../app/views/pages/$argument.php";
    }
}