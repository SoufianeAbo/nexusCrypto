<?php

class Watchlists extends  Controller
{
    private $watchlistModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->watchlistModel = $this->model('watchlist');
    }
    public function index()
    {
        // get watchlist

        $watchlists = $this->watchlistModel->getWatchlistCryptoData($_SESSION['UserID']);
        $watchlistIds = $this->watchlistModel->getWatchlistCryptoIds($_SESSION['UserID']);

        $data = [
            'watchlists' => $watchlists,
            'watchlistIds' => $watchlistIds,

        ];
        $this->view('watchlists/index', $data);
    }
    public function addToWatchlist()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        $data = [
            'user_id' =>trim($_POST['userID']) ,
            'crypto_id' => trim($_POST['cryptoID']),
            ];
        if ($this->watchlistModel->addToWatchlist($data)) {
            // Successfully added to the watchlist
            flash('watchlist_message', 'Cryptocurrencyss added to watchlist');
            redirect('watchlists/index');
        } else {

            flash('watchlist_message', 'Failed to add cryptocurrency to watchlist', 'alert alert-danger');
            redirect('cryptos');
        }
    }
    public function delete($cryptoID)
    {
        if ($this->watchlistModel->removeFromWatchlist($cryptoID)) {
            // Successfully removed from the watchlist
            flash('watchlist_message', 'Cryptocurrencyss removed from watchlist');
            redirect('watchlists/index');
            // Redirect to the watchlist page
        } else {
            // Handle error if removing from watchlist fails
            flash('watchlist_message', 'Failed to remove cryptocurrency from watchlist', 'alert alert-danger');
        }
        redirect('watchlists/index');
    }
}


