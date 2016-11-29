<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $fillable = [
    'title', 'content', 'writer'
  ];

  public static function valid() {
  return array(
    'content' => 'required'
    );
  }

	public function comments() {
	   return $this->hasMany('App\Comment', 'article_id');
  	}

  public static function request_ajax($request) 
  {
    if ($request->direction) {
      if ($request->page){
        $articles = Article::orderBy('id', $request->direction)->paginate(4);
        $direction = $request->direction;
      }
      else {
        $request->direction == 'asc' ? $direction = 'desc' : $direction = 'asc';
        $articles = Article::orderBy('id', $direction)->paginate(4);
      }
    }
    else {
      $articles = Article::orderBy('created_at', 'desc')->paginate(4);
      $direction = null; 
    }
    return ['view' => $articles, 'direction' => $direction ];
  }
}
