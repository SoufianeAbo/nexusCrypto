<?php

// Load the controller
require_once '../app/controllers/Cryptocurrency_controller.php';
$cryptoController = new CryptoController();

// Call the controller method
$cryptoController->index();

?>