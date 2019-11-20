<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyUser;

class UserController extends Controller
{
    /**
     * Show the signin page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signin( Request $request ){
        return view('signin')->with('message',$request->session()->get('message') ?? null);
    }
    /**
     * Show the signup page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup( Request $request ){
        return view('signup')->with('message',$request->session()->get('message') ?? null);
    }
    /**
     * Show the formpassword page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function formpassword( Request $request ){
        return view('formpassword')->with('message',$request->session()->get('message') ?? null);
    }
    /**
     * Show the signout page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signout( Request $request ){
        $request->session()->flush();
        return redirect('signin')->with('message',$request->session()->get('message') ?? null);
    }
    /**
     * Show the welcome page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function welcome( Request $request ){
        return view('welcome')->with(['message' =>$request->session()->get('message') ?? null,
            'user' =>$request->session()->get('user')]);
    }
    /**
     * Show the authenticate page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate( Request $request ){
        // On reset les messages
        $request->session()->forget('message');


        // On vérifie qu'on a bien reçu les données en POST
        if ( !($request->has('login') && $request->has('password')) )
        {
            $request->session()->put('message', "Some POST data are missing.");
            return redirect('signin');
        }

        // On les sécurise les données POST.
        $login = htmlspecialchars($request->get('login'));
        $password = htmlspecialchars($request->get('password'));

        //On crée l'utilisateur
        $user = new MyUser($login,$password);

        try {
            // On vérifie qu'il existe dans la BDD
            if ( !$user->exists() )
            {
                $request->session()->put('message', 'Wrong login/password.');
                return redirect('signin');
            }
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $request->session()->put('message', $e->getMessage());
            return redirect('signin');
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->exists())
            $request->session()->put('message', $e->getMessage());
            return redirect('signin');
        }

        /******************************************************************************
         * Si tout est ok, on se connecte et se rend sur welcome.php
         */
        $request->session()->put('user', $login);
        return redirect('admin/welcome');
    }

    /**
     * Show the adduser page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adduser( Request $request ){
        // On reset les messages
        $request->session()->forget('message');

        // On vérifie qu'on a bien reçu les données en POST
        if ( !($request->has('login') && $request->has('password') && $request->has('confirm') ))
        {
            $request->session()->put('message', "Some POST data are missing.");
            return redirect('signup');
        }

        // On les sécurise les données POST.
        $login = htmlspecialchars($request->get('login'));
        $password = htmlspecialchars($request->get('password'));
        $confirm = htmlspecialchars($request->get('confirm'));

        if ( $password !== $confirm )
        {
            $request->session()->put('message', "The two passwords differ.");
            return redirect('signup');
        }

        //On crée l'utilisateur
        $user = new MyUser($login,$password);

        try {
            // On crée l'utilisateur dans la BDD
            $user->create();
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $request->session()->put('message', $e->getMessage());
            return redirect('signup');
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->create())
            $request->session()->put('message', $e->getMessage());
            return redirect('signup');
        }

        /******************************************************************************
         * Si tout est ok, on indique que le compte est crée et on se rend sur signin.php
         */
        $request->session()->put('message', "Account created! Now, signin.");
        return redirect('signin');
    }

    /**
     * Show the changepassword page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changepassword( Request $request ){


        // On reset les messages
        $request->session()->forget('message');

        // On vérifie qu'on a bien reçu les données en POST
        if ( !($request->has('newpassword')&&$request->has('confirmpassword')) )
        {
            $request->session()->put('message', "Some POST data are missing.");
            return redirect('formpassword');
        }

        // On les sécurise les données POST.
        $login           = $request->session()->get('user');
        $newpassword     = htmlspecialchars($request->get('newpassword'));
        $confirmpassword = htmlspecialchars($request->get('confirmpassword'));

        // On s'assure que les 2 mts de passes corrspondent
        if ( $newpassword != $confirmpassword )
        {
            $request->session()->put('message', "Error: passwords are different.");
            return redirect('formpassword');
        }

        //On crée l'utilisateur
        $user = new MyUser($login);

        try {
            $user->changePassword($newpassword);
        }
        catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $request->session()->put('message', $e->getMessage());
            return redirect('admin/formpassword');
        }
        catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->changePassword())
            $request->session()->put('message', $e->getMessage());
            return redirect('admin/formpassword');
        }

        /******************************************************************************
         * Si tout est ok, on retourne sur welcome.php
         */
        $request->session()->put('message', "Password successfully updated.");
        return redirect('admin/welcome');
    }
    /**
     * Show the deleteuser page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteuser( Request $request ){
        // On reset les messages
        $request->session()->forget('message');

        $login = $request->session()->get('user');

        //On crée l'utilisateur
        $user = new MyUser($login);

        // Création de l'objet PDO
        try {
            // On crée l'utilisateur dans la BDD
            $user->delete();
        } catch (\PDOException $e) {
            // Si erreur lors de la création de l'objet PDO
            // (déclenchée par MyPDO::pdo())
            $request->session()->put('message', $e->getMessage());
            return redirect('admin/welcome');
        } catch (\Exception $e) {
            // Si erreur durant l'exécution de la requête
            // (déclenchée par le throw de $user->create())
            $request->session()->put('message', $e->getMessage());
            return redirect('admin/welcome');
        }

        /******************************************************************************
         * Si tout est ok, on détruit la session et retourne sur signin.php
         */
        $request->session()->flush();
        $request->session()->put('message', "Account successfully deleted.");
        return redirect('signin');
    }
}
