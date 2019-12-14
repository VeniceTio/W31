<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Partie publique ------------------------------------------------------------

// Racine
$router->get('/', function () { return view('signin'); });

// Connexion
$router->get( 'signin', function () { return view('signin'); });
$router->post('signin', function () { return redirect('signin'); });
$router->get( 'authenticate', function () { return redirect('signin'); });
$router->post('authenticate',
    ['middleware' => 'session', 'uses' => 'UserController@authenticate'] );

// Inscription
$router->get( 'signup', function () { return view('signup'); });
$router->post('signup', function () { return redirect('signup'); });
$router->get( 'adduser', function () { return redirect('signup'); });
$router->post('adduser',
    ['middleware' => 'session', 'uses' => 'UserController@adduser'] );

// Partie account -------------------------------------------------------------

$router->group(
    ['prefix' => 'account','middleware' => 'session'],
    function () use ($router) {
        // Déconnexion
        $router->get('signout', ['uses' => 'UserController@signout']);

        // Page d'accueil
        $router->get ('/',       function () { return view('welcome'); });
        $router->get ('welcome', function () { return view('welcome'); });
        $router->post('welcome', function () { return redirect('signin'); });

        // Changement du mot de passe
        $router->get ('formpassword', function () { return view('formpassword'); });
        $router->post('formpassword', function () { return redirect('signin'); });
        $router->get ('changepassword', function () { return redirect('formpassword'); });
        $router->post('changepassword', ['uses' => 'UserController@changePassword']);

        // Supprimer mon compte
        $router->get ('deleteuser', ['uses' => 'UserController@deleteUser']);
        $router->post('deleteuser', function () { return redirect('welcome'); });

        //=====================================================================

        $router->get ('managepostes', function() { return view('managepostes'); });
        $router->post('managepostes', function() { return redirect('managepostes'); });

        $router->get ('allpostes', ['uses' => 'PostesController@allPostes']);
        $router->post('allpostes', function() { return redirect('managepostes'); });

        $router->get ('ajouterposte', function() { return view('formajouterposte'); });
        $router->post('ajouterposte', ['uses' => 'PostesController@ajouterPoste']);

        $router->get ('supprimerposte/{id}', ['uses' => 'PostesController@supprimerPoste']);
        $router->post('supprimerposte', function() { return redirect('managepostes'); });

        $router->get ('allreservations', ['uses' => 'ReservationsController@allReservations']);
        $router->post('allreservations', function() { return redirect('managepostes'); });

        $router->get ('ajouterreservation', function() { return view('formajouterreservation'); });
        $router->post('ajouterreservation', ['uses' => 'ReservationsController@ajouterReservation']);

        $router->get ('supprimerreservation/{id}', ['uses' => 'ReservationsController@supprimerReservation']);
        $router->post('supprimerreservation', function() { return redirect('managepostes'); });

        $router->get ('reservations/{id}', ['uses' => 'ReservationsController@duPoste']);
        $router->post('reservations/{id}', function() { return redirect('managepostes'); });

        $router->get ('mypostes', ['uses' => 'PostesController@userPostes']);
        $router->post('mypostes', function() { return redirect('managepostes'); });
    }
);
