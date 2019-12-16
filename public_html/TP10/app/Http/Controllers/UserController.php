<?php

namespace App\Http\Controllers;

use App\Games;
use App\UserEloquent;
use Illuminate\Http\Request;

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
        return view('formpassword')
            ->with('user', $request->session()->get('user') ?? null)
            ->with('message',$request->session()->get('message') ?? null);
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
            'user' =>$request->session()->get('user'),'user_id' =>$request->session()->get('user_id'),
            'age' => $request->session()->get('age')]);
    }
    /**
     * Show the authenticate page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate( Request $request ){
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
        $request->session()->put(['user' => $user->user,'user_id' => $user->id ]);
        return redirect('admin/welcome')->with('age',$user->age);
    }

    /**
     * Show the adduser page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adduser( Request $request ){
        // On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['login','password','confirm','age']) )
            return redirect('signup')->with('message',"Some POST data are missing.");

        if ( $request->input('password') !== $request->input('confirm') )
            return redirect('signup')->with('message',"The two passwords differ.");

        //On crée l'utilisateur
        $user = new UserEloquent();
        $user->user = $request->input('login');
        $user->password = password_hash($request->input('password'),PASSWORD_DEFAULT);
        $user->age = $request->input('age');

        try {
            // On crée l'utilisateur dans la BDD
            $user->save();
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('signup')
                ->with('message','This login is still used. Please choose another one.');
        }

        // Si tout est ok, on indique que le compte est crée et on se rend sur signin
        return redirect('signin')
            ->with('message',"Account created! Now, signin.");
    }

    /**
     * Show the changepassword page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changepassword( Request $request ){
// On vérifie qu'on a bien reçu les données en POST
        if ( !$request->has(['newpassword','confirmpassword']) )
            return redirect('admin/formpassword')
                ->with('user', $request->session()->get('user') ?? null)
                ->with('message',"Some POST data are missing.");

        // On s'assure que les 2 mots de passes correspondent
        if ( $request->input('newpassword') != $request->input('confirmpassword') )
            return redirect('admin/formpassword')
                ->with('user', $request->session()->get('user') ?? null)
                ->with('message',"Error: passwords are different.");

        //On crée l'utilisateur
        $user = UserEloquent::where('user',$request->session()->get('user'))->first();
        $user->password = password_hash($request->input('newpassword'),PASSWORD_DEFAULT);
        $user->save();

        // Si tout est ok, on retourne sur welcome
        return redirect('admin/welcome')
            ->with('user', $request->session()->get('user') ?? null)
            ->with('message',"Password successfully updated.");
    }
    public function changeage( Request $request ){
        if ( !$request->has(['newage']) ){
            return redirect('admin/formpassword')
                ->with('user', $request->session()->get('user') ?? null)
                ->with('message',"Some POST data are missing.");
        }
        $age = $request->get('newage');
        UserEloquent::where('id',$request->session()->get('user_id'))->update(['age' => $age]);
        // Si tout est ok, on retourne sur welcome
        return redirect('admin/welcome')
            ->with('user', $request->session()->get('user') ?? null)
            ->with('age',$age)
            ->with('message',"Password successfully updated.");
    }
    /**
     * Show the deleteuser page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteuser( Request $request ){
        Games::where('Publié',0)->delete();
        // On détruit l'utilisateur de la BDD
        UserEloquent::destroy($request->session()->get('user'));

        // Si tout est ok, on détruit la session et retourne sur signin
        $request->session()->flush();
        return redirect('signin')->with('message',"Account successfully deleted.");
    }
}
