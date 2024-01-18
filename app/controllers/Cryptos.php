<?php
class Cryptos extends Controller {
    private $cryptoModel;
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->cryptoModel = $this->model('crypto');
    }
    public function index() {
        $apiKey = '436015aa-6648-4e76-8e91-6e1ed0ea0bd6';
        $cryptoData = $this->cryptoModel->getCryptoMarketData($apiKey);
        $topten = $this->cryptoModel->fetchTopGainers($apiKey, $limit = 10);

        $data = [
            'cryptoData' => $cryptoData,
            'topten' => $topten
        ];

        $this->view('cryptos/index', $data);
    }
}
