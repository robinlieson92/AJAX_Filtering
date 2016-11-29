<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use DB;
use App\Http\Requests\ArticleRequest;
use Session;

class ArticlesController extends Controller
{
    public function __construct() {
        $this->middleware('sentinel');
        $this->middleware('sentinel.role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            if ($request->ajax()) {
                $hasil = Article::request_ajax($request);
                // $request->direction == 'asc' ? $direction = 'desc' : $direction = 'asc';
                $direction = $hasil['direction'];
                $view = (String)view('articles._index')
                ->with('articles', $hasil['view'])
                ->render();
            return response()->json(['view' => $view,'direction' => $direction]);
            } else {

                    $articles = Article::orderBy('created_at', 'desc')->paginate(4);
                    return view('articles.index')
                    ->with('articles', $articles);
  

            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        DB::beginTransaction();
        try {
            Article::create($request->all());
            Session::flash("notice", "Article success created");
        }
        catch (\Exception $e) {
            DB::rollBack();
            Session::flash("error", "Sorry, something went wrong at ".$e);
        }
        DB::commit();  
        return redirect()->route("articles.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
        $article = Article::find($id);
        $comments = Article::find($id)->comments->sortBy('Comment.created_at');
            return view('articles.show')
                ->with('article', $article)
                ->with('comments', $comments); }
        catch (\Exception $e) {
            Session::flash("error", "Sorry, something went wrong at ".$e);
            return redirect()->route("articles.index");
        }
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit')
            ->with('article', $article);
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            Article::find($id)->update($request->all());
            Session::flash("notice", "Article success updated");
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash("error", "Sorry, something went wrong at ".$e);
        }
        DB::commit(); 
        return redirect()->route("articles.show", $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Article::find($id)->comments()->forceDelete();
            Article::destroy($id);
            Session::flash("notice", "Article success deleted");
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash("error", "Sorry, something went wrong at ".$e);
        }
        DB::commit(); 
        return redirect()->route("articles.index");
    }
}
