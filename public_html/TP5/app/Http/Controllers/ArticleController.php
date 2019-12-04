<?php

namespace App\Http\Controllers;

use App\article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function home( Request $request )
    {
        $articles = article::where('Publié','=', 1)->orderBy('Date_Publication','DESC')->limit(3)->get();
        $Allarticles = article::where('Publié','=', 1)->orderBy('Date_Publication','DESC')->get();
        if(!empty($articles)) {
            return view('home')
                ->with('logged', $request->session()->get('login') ?? null)
                ->with('articles', $articles)
                ->with('Allarticles',$Allarticles);
        } else {
            return view('home')
                ->with('logged', $request->session()->get('login') ?? null);
        }
    }
}
