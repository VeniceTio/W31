<?php

namespace App\Http\Controllers;

use App\UserEloquent;
use App\VideoGame;
use Illuminate\Http\Request;

class VideoGameController extends Controller
{
    public function newGame(Request $request){
        return view('newGame')
            ->with('user', $request->session()->get('user') ?? null);
    }
    public function createGame(Request $request)
    {
        // On vérifie qu'on a bien reçu les données en POST
        if (!$request->has(['name', 'url','desc'])) {
            return redirect('home')->with('error_message', 'Some POST data are missing.');
        }
        try{
            $id = UserEloquent::where('user','=',$request->session()->get('user'))->firstOrFail();
        } catch ( \Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
            return redirect('home')->with('message','Error category not found.');
        }

        $titre = $request->input('name');
        $author = $id->id;
        $url = $request->input('url');
        $desc = $request->input('desc');

        $game = new VideoGame();
        $game->Nom = $titre;
        $game->owner = $author;
        $game->URL = $url;
        $game->description = $desc;

        try {
            $game->save();
            //article::create(['Titre' => $article->Titre, 'Auteur' => $article->Auteur,
            //    'Rubrique' => $article->Rubrique, 'Phrase_article' => $article->Phrase_accroche,
            //    'Contenu_textuel' => $article->Contenu_textuel, 'Publié' => $article->Publié]);
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/write/newArticle')->with('error_message','Le nom d\'article existe deja!')->with('exep',$e);
        }

        return redirect('/admin/write/myArticles');
    }
    public function myGames(Request $request){
        $articles = VideoGame::where('owner',$request->session()->get('user_id'))->get();
        return view('myGames')
            ->with('articles',$articles)
            ->with('user', $request->session()->get('user') ?? null);
    }
}
