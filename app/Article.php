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
    if($request->keywords) {
      if ($request->direction) {
          $articles = Article::where('title', 'like', '%'.$request->keywords.'%')
              ->orWhere('content', 'like', '%'.$request->keywords.'%')
              ->orWhere('writer','like','%'.$request->keywords.'%')
              ->orderBy('id',$request->direction)
              ->paginate(2);
      }
      else {
          $articles = Article::where('title', 'like', '%'.$request->keywords.'%')
              ->orWhere('content', 'like', '%'.$request->keywords.'%')
              ->orWhere('writer','like','%'.$request->keywords.'%')
              ->orderBy('created_at','asc')
              ->paginate(2); 
      }
    }
    else {
        if ($request->direction)
        {
          $articles = Article::orderBy('id', $request->direction)->paginate(2);
          $request->direction == 'asc' ? $direction = 'desc' : $direction = 'asc'; 
        }
        else
        {
          $articles = Article::orderBy('created_at', 'asc')->paginate(2); 
        }
    }
    return [
    'view' => $articles,
    'direction' => $direction
    ];
  }
}
