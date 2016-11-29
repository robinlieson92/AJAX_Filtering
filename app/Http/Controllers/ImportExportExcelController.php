<?php

namespace App\Http\Controllers;
use Session, Excel, DB;
use App\Http\Requests\ImportExcelRequest;
use App\Article;
use App\Comment;


use Illuminate\Http\Request;

class ImportExportExcelController extends Controller
{
    public function exportExcelArticles()
    {
    	$data = Article::get()->toArray();
    	return Excel::create('ExportArticles', function($excel) use ($data) {
    		$excel->sheet('sheetArticles', function($sheet) use ($data)
    		{
    			$sheet->fromArray($data);
    			$sheet->freezeFirstRow();
    		});
    	})->download('xls');
    }

    public function exportExcelComments($id)
    {
        $article_title = Article::find($id)->title;
        $article = Article::select('title','content','writer')
                        ->where('id',$id)->get()->toArray();
        $comments = Article::find($id)->comments()
            ->get(['content','user','created_at','updated_at'])->toArray();

        return Excel::create('ExportComments'.$article_title, 
            function($excel_comments) use ($article, $comments) {
            $excel_comments->sheet('sheet_article', function($sheet_article) use ($article)
            {
                $sheet_article->fromArray($article);
            });
            $excel_comments->sheet('sheet_comments', function($sheet_comment) use ($comments)
            {
                $sheet_comment->fromArray($comments);
            });  
        })->download('xls');
    }

    public function importExcelArticles(ImportExcelRequest $request)
    {
        if($request->hasFile('import_file')){
            $import_file = $request->file('import_file');

            $articles = Excel::selectSheetsByIndex(0)->load($import_file, function($reader) {})->get()->toArray();

            foreach ($articles as $value) {
                $articles = new Article();
                $articles->title = $value['title'];
                $articles->content = $value['content'];
                $articles->writer = $value['writer'];
                $articles->save();
            }
            $articles_id = $articles->id;

            $comments = Excel::selectSheetsByIndex(1)->load($import_file, function($reader) {})->get()->toArray();

            foreach ($comments as $value) {
                $comments = new Comment();
                $comments->article_id = $articles_id;
                $comments->content = $value['content'];
                $comments->user = $value['user'];
                $comments->save();
            }
        }
        return redirect()->route('articles.index');
    }
}
