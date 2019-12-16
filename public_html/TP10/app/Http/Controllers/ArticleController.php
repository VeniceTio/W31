<?php

namespace App\Http\Controllers;

use App\article;
use App\Categories;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class ArticleController extends Controller
{
    public function home( Request $request )
    {
        $articles = article::where('Publié','=', 1)->orderBy('Date_Publication','DESC')->limit(3)->get();
        $Allarticles = article::where('Publié','=', 1)->orderBy('Date_Publication','DESC')->get();
        if(!empty($articles)) {
            return view('home')
                ->with('user', $request->session()->get('user') ?? null)
                ->with('articles', $articles)
                ->with('Allarticles',$Allarticles);
        } else {
            return view('home')
                ->with('user', $request->session()->get('user') ?? null);
        }
    }
    public function getArticle( Request $request, $id ){
        try {
            $article = article::where('id', $id)->firstOrFail();
        } catch ( \Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
            return redirect('home')->with('message','Error article not found.');
        }
        return view('article')
            ->with('user', $request->session()->get('user') ?? null)
            ->with('article',$article)
            ->with('catId',$article->Rubrique);
    }

    public function getCategories( Request $request){
        try {
            $categories = categories::all();
        } catch ( \Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
            return redirect('home')->with('message','Error article not found.');
        }
        return view('categories')
            ->with('user', $request->session()->get('user') ?? null)
            ->with('categories',$categories);
    }

    public function getArticles( Request $request, $id){
        try {
            $articles = article::where('Rubrique',"=", $id)->where('Publié','1')->get();
        } catch ( \Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
            return redirect('home')->with('message','Error article not found.');
        }
        return view('category')
            ->with('articles',$articles)
            ->with('catId',$id)
            ->with('user', $request->session()->get('user') ?? null);
    }

    public function getArticleByCategory( Request $request, $catId, $id ){
        try {
            $article = article::where('id', $id)->where('Publié','1')->firstOrFail();
        } catch ( \Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
            return redirect('home')->with('message','Error article not found.');
        }
        return view('article')
            ->with('user', $request->session()->get('user') ?? null)
            ->with('article',$article)
            ->with('catId',$catId);
    }
    public function newArticle(Request $request){
        $categories = Categories::select('name')->get();
        return view('newArticle')
            ->with('categories', $categories)
            ->with('user', $request->session()->get('user') ?? null);
    }

    public function createArticle(Request $request)
    {
        // On vérifie qu'on a bien reçu les données en POST
        if (!$request->has(['titre', 'category','accroche', 'content'])) {
            return redirect('home')->with('error_message', 'Some POST data are missing.');
        }
        try{
        $id = Categories::where('name','=',$request->input('category'))->firstOrFail();
        } catch ( \Illuminate\Database\Eloquent\ModelNotFoundException $e ) {
            return redirect('home')->with('message','Error category not found.');
        }
        $titre = $request->input('titre');
        $author = $request->session()->get('user');
        $acro = $request->input('accroche');
        $content = $request->input('content');
        $publish = '0';
        $rubric = $id->id;

        $article = new article();
        $article->Titre = $titre;
        $article->Rubrique = $rubric;
        $article->Auteur = $author;
        $article->Phrase_accroche = $acro;
        $article->Contenu_textuel = $content;
        $article->Publié = $publish;

        try {
            $article->save();
            //article::create(['Titre' => $article->Titre, 'Auteur' => $article->Auteur,
            //    'Rubrique' => $article->Rubrique, 'Phrase_article' => $article->Phrase_accroche,
            //    'Contenu_textuel' => $article->Contenu_textuel, 'Publié' => $article->Publié]);
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin/write/newArticle')->with('error_message','Le nom d\'article existe deja!')->with('exep',$e);
        }

        return redirect('/admin/write/myArticles');
    }
    public function myArticles(Request $request){
        $articles = article::where('Auteur',$request->session()->get('user'))->get();
        return view('myArticles')
            ->with('articles',$articles)
            ->with('user', $request->session()->get('user') ?? null);
    }
    public function publish(Request $request,$id,$etat){
        article::where('id',$id)->update(['Publié' => $etat]);
        $articles = article::where('Auteur',$request->session()->get('user'))->get();
        return view('myArticles')
            ->with('articles',$articles)
            ->with('user', $request->session()->get('user') ?? null);
    }
    public function delete(Request $request, $id){
        article::where('id',$id)->delete();
        $articles = article::where('Auteur',$request->session()->get('user'))->get();
        return view('myArticles')
            ->with('articles',$articles)
            ->with('user', $request->session()->get('user') ?? null);
    }
}
