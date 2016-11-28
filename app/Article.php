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

    }
    else {
      $articles = Article::orderBy('created_at', 'desc')->paginate(2); 
    }
    return ['view' => $articles, 'direction' => $direction ];
  }
}
