<?php

namespace App\Http\Controllers;
use Session, Excel;
use App\Http\Requests\ImportExcelRequest;
use App\Article;


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
        if($request->file('import_file')->isValid()){
            $path = $request->file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                    'title' => $value->title, 
                    'content' => $value->content,
                    'writer' => $value->writer
                    ];
                }
                if(!empty($insert)){
                    Article::insert($insert);
                    Session::flash("notice", "Insert Record successfully");
                    return redirect()->route("articles.index");
                }
            }
        }
        else{
            Session::flash("notice", "Insert Record error");
            return redirect()->route("articles.index");
        }
        return back();
    }
}
