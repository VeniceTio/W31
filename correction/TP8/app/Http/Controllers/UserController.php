<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserEloquent;

class UserController extends Controller
{
    /**
     * Show the signin page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signin( Request $request )
    {
        return view('signin')->with( 'message', $request->session()->get('message') );
    }

    /**
     * Show the signup page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signup( Request $request )
    {
        return view('signup')->with( 'message', $request->session()->get('message') );
    }

    /**
     * Show the change password form
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function formpassword( Request $request )
    {
        return view('formpassword')->with( 'message', $request->session()->get('message') );
    }

    /**
     * Signout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signout( Request $request )
    {
        $request->session()->flush();
        return redirect('signin');
    }

    /**
     * Show the welcome page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function welcome( Request $request )
    {
        return view('welcome')
            ->with('user',$request->session()->get('user'))
            ->with('message',$request->session()->get('message'));
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate( Request $request )
    {
        // On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['login','password']) )
            return redirect('signin')->with('message','Some POST data are missing.');

        // On récupère l'utilisateur en BDD
        try {
            $user = UserEloquent::where('user',$request->input('login'))->firstOrFail();
        }
        catch ( \Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
            return redirect('signin')->with('message','Wrong login.');
        }

        // On vérifie que les mots de passe correspondent
        if ( !password_verify($request->input('password'), $user->password) )
            return redirect('signin')->with('message','Wrong password.');

        // Si tout est ok, on se connecte et se rend sur welcome
        $request->session()->put('user',$user->user);
        return redirect('admin/welcome');
    }

    /**
     * Create a new account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addUser( Request $request )
    {
        // On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['login','password','confirm']) )
            return redirect('signup')->with('message',"Some POST data are missing.");

        if ( $request->input('password') !== $request->input('confirm') )
            return redirect('signup')->with('message',"The two passwords differ.");

        //On crée l'utilisateur
        $user = new UserEloquent;
        $user->user = $request->input('login');
        $user->password = password_hash($request->input('password'),PASSWORD_DEFAULT);

        try {
            // On crée l'utilisateur dans la BDD
            $user->save();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('signup')->with('message','This login is still used. Please choose another one.');
        }

        // Si tout est ok, on indique que le compte est crée et on se rend sur signin
        return redirect('signin')->with('message',"Account created! Now, signin.");
    }

    /**
     * Change password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword( Request $request )
    {
        // On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['newpassword','confirmpassword']) )
            return redirect('admin/formpassword')->with('message',"Some POST data are missing.");

        // On s'assure que les 2 mots de passes correspondent
        if ( $request->input('newpassword') != $request->input('confirmpassword') )
            return redirect('admin/formpassword')->with('message',"Error: passwords are different.");

        //On crée l'utilisateur
        $user = UserEloquent::where('user',$request->session()->get('user'))->first();
        $user->password = password_hash($request->input('newpassword'),PASSWORD_DEFAULT);
        $user->save();

        // Si tout est ok, on retourne sur welcome
        return redirect('admin/welcome')->with('message',"Password successfully updated.");
    }

    /**
     * Delete user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteUser( Request $request )
    {
        // On détruit l'utilisateur de la BDD
        UserEloquent::destroy($request->session()->get('user'));

        // Si tout est ok, on détruit la session et retourne sur signin
        $request->session()->flush();
        return redirect('signin')->with('message',"Account successfully deleted.");
    }
}
