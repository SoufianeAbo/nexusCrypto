<?php
// CryptoController.php
require_once '../app/models/Portfolio.php';

class CryptoController {
    private $cryptoModel;

    public function __construct() {
        $this->cryptoModel = new QuantityCryptoModel();
    }

    public function index() {
        session_start();
        // if (isset($_SESSION['userID'])) {
        //     $userID = $_SESSION['userID'];

        //     $cryptoData = $this->cryptoModel->getCryptoDataByUserID($userID);

        //     // Include the view
        //     require '../views/pages/portfolio.php';
        // } else {
        //     echo "User not logged in.";
        // }

        $userID = 1;
        $apiKey = 'c8328ac7-3c86-4a07-baec-8d7a6728e626';
        $cryptoData = $this->cryptoModel->getCryptoData($apiKey);
        $portfolioData = $this->cryptoModel->getCryptoDataByUserID($userID);
        require '../app/views/pages/portfolio.php';
    }
}
?>
