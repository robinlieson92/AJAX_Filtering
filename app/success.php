<?php
/* if($request->keywords) {
      if ($request->direction) {
          $request->direction == 'asc' ? $direction = 'desc' : $direction = 'asc';
          $articles = Article::where('title', 'ilike', '%'.$request->keywords.'%')
              ->orWhere('content', 'like', '%'.$request->keywords.'%')
              ->orWhere('writer','like','%'.$request->keywords.'%')
              ->orderBy('id',$direction)
              ->paginate(2);
      }
      else {
          $articles = Article::where('title', 'ilike', '%'.$request->keywords.'%')
              ->orWhere('content', 'like', '%'.$request->keywords.'%')
              ->orWhere('writer','like','%'.$request->keywords.'%')
              ->orderBy('created_at','asc')
              ->paginate(2);
          $direction = $request->direction; 
      }
    }
    else {
        if ($request->direction)
        {
          if ($request->page){
            $articles = Article::orderBy('id', $request->direction)->paginate(4);
            $direction = $request->direction;
          }
          else{
            $request->direction == 'asc' ? $direction = 'desc' : $direction = 'asc';
            $articles = Article::orderBy('id', $direction)->paginate(4);  
          }
        }
        else
        {
          $articles = Article::orderBy('created_at', 'desc')->paginate(2); 
        }
    }
    return [
    'view' => $articles,
    'direction' => $direction
    ];
  } */