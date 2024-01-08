<?php

// Load the controller
require_once '../app/controllers/Portfolios.php';
$cryptoController = new CryptoController();

// Call the controller method
$cryptoController->index();

?>